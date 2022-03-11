<?php

namespace App\DataTables;

use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Services\NumberFormatterService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class Matter2DataTable extends DataTable
{
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
                                ' . $model->expert->name . '
                                ' . (($model->expert->name != $model->assistants->first()->name) ?
                    '<div class="fs-7 text-muted fw-bolder">' . $model->assistants->first()->name . '</div>' : '') . '
                        </div>';
            })
            ->editColumn('court_id', function ($model) {
                return '<div class="position-relative">
                                ' . $model->court->name . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->type->name . '</div>
                        </div>';
            })
            ->editColumn('plaintiff_name', function ($model) {
                return '<div class="position-relative">
                                ' . \Str::of($model->plaintiffs->first()->name)->limit(30) . '
                            <div class="text-danger">' . \Str::of($model->defendants->first()->name)->limit(30)  . '</div>
                        </div>';
            })
            ->editColumn('next_session_date', function ($model) {
                return '<div class="position-relative">
                                ' .  $model->nextSessionDateProcedure->last()->datetime->format('Y-m-d') . '
                            <div class="fs-7 text-muted fw-bolder">' .  $model->receivedDateProcedure->first()->datetime->format('Y-m-d') . '</div>
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
                return $query->whereHas('expert', function ($q) use ($keyword) {
                    $q->where('experts.name', 'like', '%' . $keyword . '%');
                });
                $matters = Matter::whereHasMorph('assistants', [Expert::class], function ($subquery, $type) use ($keyword) {
                    if ($type === Expert::class) {
                        $subquery->where('experts.name', 'like', '%' . $keyword . '%');
                    }
                })->get()->pluck('id')->toArray();
                $query->whereIn($matters);
            })
            ->filterColumn('court_id', function ($query, $keyword) {
                return $query->whereHas('court', function ($q) use ($keyword) {
                    $q->where('courts.name', 'like', '%' . $keyword . '%');
                })->whereHas('type', function ($q) use ($keyword) {
                    $q->where('types.name', 'like', '%' . $keyword . '%');
                });
            })
            ->filterColumn('plaintiff_name', function ($query, $keyword) {
                $matters = Matter::whereHasMorph('plaintiffs', [Party::class], function ($subquery, $type) use ($keyword) {
                    if ($type === Party::class) {
                        $subquery->where('parties.name', 'like', '%' . $keyword . '%');
                    }
                })->get()->pluck('id')->toArray();
                $query->whereIn($matters);
                $matters = Matter::whereHasMorph('defendants', [Party::class], function ($subquery, $type) use ($keyword) {
                    if ($type === Party::class) {
                        $subquery->where('parties.name', 'like', '%' . $keyword . '%');
                    }
                })->get()->pluck('id')->toArray();
                $query->whereIn($matters);
            })
            ->filterColumn('next_session_date', function ($query, $keyword) {
                return $query->orWhere('procedures_received_date.datetime', 'like', '%' . $keyword . '%')
                    ->orWhere('procedures_next_session_date.datetime', 'like', '%' . $keyword . '%');
            })
            ->filterColumn('claims_sum_amount', function ($query, $keyword) {
                return $query->orWhere('claims_sum_amount', 'like', '%' . $keyword . '%');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Matter2 $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Matter $model)
    {
        return $model->with([
            'court:id,name',
            'expert:id,name',
            'type:id,name',
            'assistants:id,experts.name',
            'plaintiffs:id,parties.name',
            'defendants:id,parties.name',
            'receivedDateProcedure:id,procedures.matter_id,procedures.datetime',
            'nextSessionDateProcedure:id,procedures.matter_id,procedures.datetime',
        ])->withSum('claims', 'amount')->newQuery();
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
        return 'Matter2_' . date('YmdHis');
    }
}
