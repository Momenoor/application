<?php

namespace App\DataTables;

use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PermissionDatatable extends DataTable
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
            ->editColumn('role',function($model){
                return $model->roles->map(function($item){
                    return $item->name;
                })->all();

            })
            ->addColumn('action', 'common.table-action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PermissionDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {


        return $model->with('roles')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('permission-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->dom("<'row'<'col-sm-12'tr>> +
        <'row'<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'l i><'col-sm-7col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>>'")
            ->parameters([
                'scrollX' => true,
                'searchDelay' => 50,
                'responsive' => true
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

            Column::make('id')->attributes(['class' => 'text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0'])->title(__('app.id')),
            Column::make('name')->attributes(['class' => 'text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0'])->title(__('app.name')),
            Column::make('role')->attributes(['class' => 'text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0'])->title(__('app.assigned_to')),
            Column::computed('action')->attributes(['class' => 'text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0'])->title(__('app.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'Permission_' . date('YmdHis');
    }
}
