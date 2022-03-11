<?php

namespace App\DataTables;

use App\Models\Matter;
use App\Services\NumberFormatterService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MatterDataTable extends DataTable
{

    protected $model;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('number', function ($model) {
                return $model->year . '/' . $model->number;
            })
            ->editColumn('expert_id', function ($model) {
                return '<div class="position-relative">
                                ' . $model->expert_name . '
                                ' . (($model->expert_name != $model->assistant_name) ?
                    '<div class="fs-7 text-muted fw-bolder">' . $model->assistant_name . '</div>' : '') . '
                        </div>';
            })
            ->editColumn('court_id', function ($model) {
                return '<div class="position-relative">
                                ' . $model->court_name . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->type_name . '</div>
                        </div>';
            })
            ->editColumn('plaintiff_name', function ($model) {
                return '<div class="position-relative">
                                ' . \Str::of($model->plaintiff_name)->limit(30) . '
                            <div class="text-danger">' . \Str::of($model->defendant_name)->limit(30)  . '</div>
                        </div>';
            })
            ->editColumn('next_session_date', function ($model) {
                return '<div class="position-relative">
                                ' . Carbon::createFromFormat('Y-m-d H:i:s', $model->next_session_date)->format('Y-m-d') . '
                            <div class="fs-7 text-muted fw-bolder">' . Carbon::createFromFormat('Y-m-d H:i:s', $model->received_date)->format('Y-m-d') . '</div>
                        </div>';
            })
            ->editColumn('claims_sum_amount', function ($model) {
                return app(NumberFormatterService::class)->getFormattedNumber($model->claims_sum_amount);
            })
            ->rawColumns(['expert_id', 'court_id', 'plaintiff_name', 'next_session_date'])
            ->addColumn('action', function ($model) {
                return view('common.table-action')->with('model', $model);
            })
            ->filterColumn('number', function ($query, $keyword) {
                /* $statusKey = collect(Lang::get('defination.status'))->each(function ($value, $key) use ($keyword) {
                    return (\Str::of($value)->contains($keyword)) ? $value : $keyword;
                })->first(); */
                return $query->orWhere('matters.number', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.year', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('expert_id', function ($query, $keyword) {
                return $query->orWhere('experts.name', 'like', '%' . $keyword . '%')
                    ->orWhere('matter_party_pivot_assistant.assistant_name', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('court_id', function ($query, $keyword) {
                return $query->where('courts.name', 'like', '%' . $keyword . '%')
                    ->orWhere('types.name', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('plaintiff_name', function ($query, $keyword) {
                return $query->orWhere('matter_party_pivot_plaintiff.plaintiff_name', 'like', '%' . $keyword . '%')
                    ->orWhere('matter_party_pivot_defendant.defendant_name', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('next_session_date', function ($query, $keyword) {
                return $query->orWhere('procedures_received_date.datetime', 'like', '%' . $keyword . '%')
                    ->orWhere('procedures_next_session_date.datetime', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('claims_sum_amount', function ($query, $keyword) {
                return $query->orWhere('claims.amount', 'like', '%' . $keyword . '%');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Matter $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Matter $model)
    {

        return $model->select([
            'matters.*',
            \DB::raw('experts.name as expert_name'),
            \DB::raw('courts.name as court_name'),
            \DB::raw('types.name as type_name'),
            \DB::raw('SUM(claims.amount) as claims_sum_amount'),
            'matter_party_pivot_assistant.assistant_name',
            'matter_party_pivot_plaintiff.plaintiff_name',
            'matter_party_pivot_defendant.defendant_name',
            \DB::raw('procedures_received_date.datetime as received_date'),
            \DB::raw('procedures_next_session_date.datetime as next_session_date'),
        ])
            ->leftJoin('experts', 'experts.id', '=', 'matters.expert_id')
            ->leftJoin('courts', 'courts.id', '=', 'matters.court_id')
            ->leftJoin('types', 'types.id', '=', 'matters.type_id')
            ->leftJoin('claims', function ($join) {
                $join->on('matters.id', '=', 'claims.matter_id')
                    ->whereIn('claims.type', [
                        'main',
                        'additional'
                    ]);
            })
            ->leftJoin('procedures as procedures_received_date', function ($join) {
                $join->on('matters.id', '=', 'procedures_received_date.matter_id')
                    ->where('procedures_received_date.type', '=', 'received_date');
            })
            ->leftJoin('procedures as procedures_next_session_date', function ($join) {
                $join->on('matters.id', '=', 'procedures_next_session_date.matter_id')
                    ->where('procedures_next_session_date.type', '=', 'next_session_date')
                    ->orderBy('datetime', 'DESC');
            })
            ->leftJoinSub(
                \DB::table('matter_party')
                    ->select([
                        \DB::raw('matter_party.matter_id as pivot_matter_id'),
                        \DB::raw('matter_party.partiable_id as pivot_partiable_id'),
                        \DB::raw('matter_party.partiable_type as pivot_partiable_type'),
                        \DB::raw('experts.name as assistant_name'),
                    ])
                    ->rightJoin('experts', function ($join) {
                        $join->on('experts.id', '=', 'matter_party.partiable_id')
                            ->where('matter_party.type', '=', 'assistant')
                            ->where('matter_party.partiable_type', '=', 'App\\Models\\Expert');
                    }),
                'matter_party_pivot_assistant',
                function ($join) {
                    $join->on('matters.id', '=', 'matter_party_pivot_assistant.pivot_matter_id');
                }
            )
            ->leftJoinSub(
                \DB::table('matter_party')
                    ->select([
                        \DB::raw('matter_party.matter_id as pivot_defendant_matter_id'),
                        \DB::raw('matter_party.partiable_id as pivot_defendant_partiable_id'),
                        \DB::raw('matter_party.partiable_type as pivot_defendant_partiable_type'),
                        \DB::raw('parties.name as defendant_name'),
                    ])
                    ->rightJoin('parties', function ($join) {
                        $join->on('parties.id', '=', 'matter_party.partiable_id')
                            ->where('matter_party.type', '=', 'defendant')
                            ->where('matter_party.partiable_type', '=', 'App\\Models\\Party');
                    }),
                'matter_party_pivot_defendant',
                function ($join) {
                    $join->on('matters.id', '=', 'matter_party_pivot_defendant.pivot_defendant_matter_id');
                }
            )
            ->leftJoinSub(
                \DB::table('matter_party')
                    ->select([
                        \DB::raw('matter_party.matter_id as pivot_plaintiff_matter_id'),
                        \DB::raw('matter_party.partiable_id as pivot_plaintiff_partiable_id'),
                        \DB::raw('matter_party.partiable_type as pivot_plaintiff_partiable_type'),
                        \DB::raw('parties.name as plaintiff_name'),
                    ])
                    ->rightJoin('parties', function ($join) {
                        $join->on('parties.id', '=', 'matter_party.partiable_id')
                            ->where('matter_party.type', '=', 'plaintiff')
                            ->where('matter_party.partiable_type', '=', 'App\\Models\\Party');
                    }),
                'matter_party_pivot_plaintiff',
                function ($join) {
                    $join->on('matters.id', '=', 'matter_party_pivot_plaintiff.pivot_plaintiff_matter_id');
                }
            )
            ->where('matters.status', '=', 'current')
            ->groupBy('matters.id');

        /*  \DB::select([
            \DB::raw('matter_party.matter_id as pivot_matter_id'),
            \DB::raw('matter_party.partiable_id as pivot_partiable_id'),
            \DB::raw('matter_party.partiable_type as pivot_partiable_type'),
        ])->from('experts')
            ->leftJoin('matter_party', function ($join) {
                $join->on('experts.id', '=', 'matter_party.partiable_id')
                    ->where('matter_party.type', '=', 'assistant')
                    ->where('matter_party.partiable_type', '=', 'App\Models\Expert')
                    ->where('matters.id', '=', 'matter_party.matter_id');
            }), */
        /* $this->model = $model;
        /*   $search = request()->get('search')['value'];
        if (!is_null($search)) {

            if (\Str::of($search)->contains(' ')) {
                \Str::of($search)->explode(' ')->each(function ($item) {
                    return $this->applyFilter($item);
                });
            } else {
                $this->applyFilter($search);
            }

            return $this->model->withSum(
                [
                    'claims as claims_sum_amount' => function ($query) {
                        $query->whereIn('claims.type', ['main', 'additional']);
                    }
                ],
                'amount'
            );
        }

        return $this->model->with([
            'court',
            'expert',
            'assistants',
            'defendants',
            'plaintiffs',
            'type',
            'receivedDateProcedure:id,matter_id,datetime',
            'nextSessionDateProcedure:id,matter_id,datetime',
        ])->withSum(
            [
                'claims as claims_sum_amount' => function ($query) {
                    $query->whereIn('claims.type', ['main', 'additional']);
                }
            ],
            'amount'
        ); */
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('matter-table')
            ->setTableAttributes(['class' => 'table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->stateSave(true)
            ->orderBy(1)
            ->dom("'<'row'<'col-sm-7'B><'col-sm-5'f>> +
            <'row'<'col-sm-12'tr>> +
            <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'li><'col-sm-7col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>'")
            ->parameters([
                'scrollX' => true,
                "searchDelay" => 50,
                /* 'initComplete' => " function () {this.api().columns().every(function () {var column = this;var input = document.createElement('input');$(input).appendTo($(column.header()).empty()).on('change', function () {var val = $.fn.dataTable.util.escapeRegex($(this).val());column.search(val ? val : '', true, false).draw();});})}", */
            ])
            ->buttons(
                //Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                //Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('number')->searchable(true)->title('No/Year'),
            Column::make('expert_id')->searchable(true)->title('Expert/Assistant'),
            Column::make('court_id')->searchable(true)->title('Court/Type'),
            Column::make('plaintiff_name')->searchable(true)->orderable(true)->title('Parties'),
            Column::make('next_session_date')->searchable(true)->orderable(true)->title('Session/Receive'),
            Column::make('claims_sum_amount')->searchable(true)->title('Claims')->class('text-end'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Matter_' . date('YmdHis');
    }

    protected function applyFilter($keyword)
    {
        $this->model
            ->WhereHas('court', function ($query) use ($keyword) {
                $query->where('courts.name', 'like', '%' . $keyword . '%');
            });

        /*             ->orWhere('matters.number', 'like', '%' . $keyword . '%')
            ->orWhere('matters.year', 'like', '%' . $keyword . '%')
            ->orWhere('matters.status', 'like', '%' . $keyword . '%')
            ->orWhere('matters.commissioning', 'like', '%' . $keyword . '%') */
    }
}
