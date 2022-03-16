<?php

namespace App\DataTables;

use App\Models\Matter;
use App\Services\NumberFormatterService;
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


            ->editColumn('number', function ($model) {

                return '<a class="text-' . config('system.matter.status.' . $model->status . '.color') . '" href="' . route('matter.show', $model) . '">' . $model->year . '/' . $model->number . '</a>';
            })


            ->filterColumn('number', function ($query, $keyword) {
                $query->orWhere('matters.number', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.year', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.status', 'like', '%' . $keyword . '%');
            })


            ->editColumn('expert_id', function ($model) {

                return '<div class="position-relative">
                                ' . $model->expert->name . '
                                ' . ((!$model->has('assistants')) ?:
                    '<div class="fs-7 text-muted fw-bolder">' . $model->assistant->name . '</div>') . '
                        </div>';
            })


            ->filterColumn('expert_id', function ($query, $keyword) {

                $query->whereRelation('expert', 'experts.name', 'like', '%' . $keyword . '%')
                    ->orWhereRelation('assistants', 'experts.name', 'like', '%' . $keyword . '%');
            })


            ->editColumn('court_id', function ($model) {

                return '<div class="position-relative">
                                ' . $model->court->name . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->type->name . '</div>
                        </div>';
            })


            ->filterColumn('court_id', function ($query, $keyword) {

                $query->whereRelation('court', 'courts.name', 'like', '%' . $keyword . '%')
                    ->orWhereRelation('type', 'types.name', 'like', '%' . $keyword . '%');
            })


            ->editColumn('plaintiff_name', function ($model) {

                return '<div class="position-relative">
                                ' . \Str::of($model->plaintiff->name)->limit(30) . '
                            <div class="text-danger">' . \Str::of($model->defendant->name)->limit(30)  . '</div>
                        </div>';
            })


            ->filterColumn('plaintiff_name', function ($query, $keyword) {

                $query->whereRelation('parties', 'parties.name', 'like', '%' . $keyword . '%');
            })


            ->editColumn('next_session_date', function ($model) {

                return '<div class="position-relative">
                                ' .  $model->next_session_date->format('Y-m-d') . '
                            <div class="fs-7 text-muted fw-bolder">' .  $model->received_date->format('Y-m-d') . '</div>
                        </div>';
            })


            ->filterColumn('next_session_date', function ($query, $keyword) {

                return $query->where('next_session_date',  'like', '%' . $keyword . '%')
                    ->orWhere('received_date', 'like', '%' . $keyword . '%');
            })


            ->filterColumn('claims_sum_amount', function ($query, $keyword) {
                $query->whereHas('claims', function ($query) use ($keyword) {
                    $query->having(\DB::raw('SUM(claims.amount)'), 'like', '%' . $keyword . '%')->groupBy('claims.matter_id');
                });
            })


            ->addColumn('action', function ($model) {

                return view('common.table-action')->with('model', $model);
            })


            ->rawColumns(['number', 'expert_id', 'court_id', 'plaintiff_name', 'next_session_date']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Matter2 $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Matter $model)
    {
        return $model->withSum('claims', 'amount')->newQuery();
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
            ->dom("'<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>> +
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

            Column::make('number')
                ->searchable(true)
                ->title('No/Year'),

            Column::make('expert_id')
                ->searchable(true)
                ->title('Expert/Assistant'),

            Column::make('court_id')
                ->searchable(true)
                ->title('Court/Type'),

            Column::make('plaintiff_name')
                ->searchable(true)
                ->orderable(false)
                ->title('Parties'),

            Column::make('next_session_date')
                ->searchable(true)
                ->orderable(true)
                ->title('Session/Receive'),

            Column::make('claims_sum_amount')
                ->searchable(true)
                ->title('Claims')
                ->class('text-end'),
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
