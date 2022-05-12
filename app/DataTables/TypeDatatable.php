<?php

namespace App\DataTables;

use App\Models\Type;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TypeDatatable extends DataTable
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
            ->editColumn('active', function ($model) {
                if ($model->active == 'true') {
                    return '<i class="bi bi-check-square-fill text-success"></i>';
                } else {
                    return '<i class="bi bi-x-square-fill text-danger"></i>';
                }
            })
            ->addColumn('action', function ($model) {

                return view('common.table-action')->with('model', $model);
            })

            ->rawColumns(['active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TypeDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Type $model)
    {
        return $model->withCount('matters')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('type-table')
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

            Column::make('name'),
            Column::make('active'),
            Column::make('matters_count')
                ->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Type_' . date('YmdHis');
    }
}
