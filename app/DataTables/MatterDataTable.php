<?php

namespace App\DataTables;

use App\Models\Cash;
use App\Models\Matter;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MatterDataTable extends DataTable
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

            ->addIndexColumn()
            ->editColumn('number', function ($model) {

                return '<a class="text-' . config('system.matter.status.' . $model->status . '.color') . '" href="' . route('matter.show', $model) . '">' . $model->year . '/' . $model->number . '</a>';
            })


            ->filterColumn('number', function ($query, $keyword) {
                if (Str::contains($keyword, '/')) {
                    $keywords = Str::of($keyword)->explode('/');
                    $query->whereIn('matters.number', $keywords)
                        ->whereIn('matters.year', $keywords);
                }
                $query->orWhere('matters.number', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.year', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.status', 'like', '%' . $keyword . '%');
            })


            ->editColumn('expert_id', function ($model) {
                return '<div class="position-relative">
                                ' . (optional($model->expert)->name) .
                    '<div class="text-primary">' . optional($model->assistant)->name . '</div>
                        </div>';
            })


            ->filterColumn('expert_id', function ($query, $keyword) {

                $mainExperts = config('system.experts.main');
                if ($keyword == 'private') {
                    $query->whereNotIn('matters.expert_id', $mainExperts);
                } else if ($keyword == 'office') {
                    $query->whereIn('matters.expert_id', $mainExperts);
                } else {
                    $query->whereHas('expert', function ($q) use ($keyword) {
                        $q->whereRelation('account', 'name', 'like', '%' . $keyword . '%');
                    })
                        ->orWhereHas('assistants', function ($q) use ($keyword) {
                            $q->whereRelation('account', 'name', 'like', '%' . $keyword . '%');
                        });
                }
            })


            ->editColumn('court_id', function ($model) {

                return '<div class="position-relative">
                                ' . optional($model->court)->name . '
                            <div class="fs-7">' . optional($model->type)->name . '</div>
                        </div>';
            })


            ->filterColumn('court_id', function ($query, $keyword) {

                $query->whereRelation('court', 'courts.name', 'like', '%' . $keyword . '%')
                    ->orWhereRelation('type', 'types.name', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.commissioning', 'like', '%' . $keyword . '%');
            })


            ->editColumn('plaintiff_name', function ($model) {

                return '<div class="position-relative">
                                ' . (\Str::of(optional($model->plaintiff)->name)->limit(30)) . '
                            <div class="text-danger">' . (\Str::of(optional($model->defendant)->name)->limit(30))  . '</div>
                        </div>';
            })


            ->filterColumn('plaintiff_name', function ($query, $keyword) {
                $mainExperts = config('system.experts.main');
                $query->whereRelation('parties', 'parties.name', 'like', '%' . $keyword . '%');
            })


            ->editColumn('next_session_date', function ($model) {
                return '<div class="position-relative">
                                ' .  (($model->next_session_date instanceof Carbon) ? $model->next_session_date->format('Y-m-d') : __('app.not-set')) . '
                            <div class="fs-7">' .  $model->received_date->format('Y-m-d') . '</div>
                        </div>';
            })


            /* ->filterColumn('next_session_date', function ($query, $keyword) {

                return $query->where('matters.next_session_date',  'like', '%' . $keyword . '%')
                    ->orWhere('matters.received_date', 'like', '%' . $keyword . '%');
            }) */

            ->editColumn('claims_sum_amount', function ($model) {
                return '<div class="text-' . $model->getClaimStatusColorAttribute() . '" data-bs-toggle="tooltip" data-bs-placement="top" title="' . __('app.' . $model->claim_status) . '">' . $model->claims_sum_amount . '</div>';
            })

            ->filterColumn('claims_sum_amount', function ($query, $keyword) {
                $query->whereHas('claims', function ($query) use ($keyword) {
                    $query->having(\DB::raw('SUM(claims.amount)'), 'like', '%' . $keyword . '%')->groupBy('claims.matter_id');
                });
                $query->orWhere('matters.claim_status', $keyword);
            })


            ->addColumn('action', function ($model) {

                return view('common.table-action')->with('model', $model);
            })

            ->rawColumns(['number', 'expert_id', 'court_id', 'plaintiff_name', 'next_session_date', 'claims_sum_amount']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Matter2 $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Matter $model)
    {

        if (auth()->user()->can('matter-only-own-view') && auth()->user()->cannot('matter-view')) {
            return $model->with([
                'court',
                'expert',
                'assistants',
                'plaintiffs',
                'defendants',
                'type',
                'claims',
                'cashes',
                'claims.cashes'
            ])->withSum('claims', 'amount')->whereRelation('assistants', 'experts.id', '=', auth()->user()->expert->id)->newQuery();
        }
        if (auth()->user()->can('matter-view')) {
            return  $model->with([
                'court',
                'expert',
                'assistants',
                'plaintiffs',
                'defendants',
                'type',
                'claims',
                'cashes',
                'claims.cashes',
            ])->withSum('claims', 'amount')->newQuery();
        }
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
            ->addIndex()
            ->setTableAttributes(['class' => 'table table-striped table-row-bordered border-gray-300 border table-hover table-row-gray-300 align-middle'])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Brtip')
            ->stateSave(true)
            ->orderBy(1)
            ->dom("<'row'<'col-sm-12'tr>> +
        <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'li><'col-sm-7col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>'")
            ->parameters([
                'scrollX' => true,
                'searchDelay' => 50,
                'responsive' => true
                /* 'initComplete' => " function () {this.api().columns().every(function () {var column = this;var input = document.createElement('input');$(input).appendTo($(column.header()).empty()).on('change', function () {var val = $.fn.dataTable.util.escapeRegex($(this).val());column.search(val ? val : '', true, false).draw();});})}", */
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->title('#')
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center ps-2'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

            Column::make('number')
                ->searchable(true)
                ->title(__('app.no') . '/' . __('app.year')),

            Column::make('expert_id')
                ->searchable(true)
                ->title(__('app.expert') . '/' . __('app.assistant')),

            Column::make('court_id')
                ->searchable(true)
                ->title(__('app.court') . '/' . __('app.type')),

            Column::make('plaintiff_name')
                ->searchable(true)
                ->orderable(false)
                ->title(__('app.parties')),

            Column::make('next_session_date')
                ->searchable(true)
                ->orderable(true)
                ->title(__('app.session') . '/' . __('app.receive')),

            Column::make('claims_sum_amount')
                ->searchable(true)
                ->title(__('app.claims')),

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
