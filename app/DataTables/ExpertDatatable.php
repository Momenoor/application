<?php

namespace App\DataTables;

use App\Models\Expert;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ExpertDatatable extends DataTable
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
            ->editColumn('name', function ($model) {

                return '<div class="position-relative"><span class="fw-bolder">
                ' .  $model->name . '</span>
                <div class="fs-7 text-primary">' .  __('app.' . $model->field) . '</div>
                </div>';
            })
            ->editColumn('email', function ($model) {

                $email = $model->email ?: optional($model->user)->email;
                $phone = $model->phone ?: optional($model->user)->phone;

                return '<div class="position-relative">
                ' .  $email . '
                <div class="fs-7">' .   $phone . '</div>
                </div>';
            })
            ->editColumn('field', function ($model) {
                return '<span class="badge fs-8 badge-light-' . $model->categoryColor() . '">' . __('app.' . $model->category) . '</span>';
            })
            ->editColumn('active', function ($model) {
                if ($model->active == 'active') {
                    return '<i class="bi bi-check-square-fill fs-1 text-success"></i>';
                } else {
                    return '<i class="bi bi-x-square-fill fs-1 text-danger"></i>';
                }
            })
            ->editColumn('as_assistant_count', function ($model) {
                return $model->as_assistant_count . ' (<span class="text-primary">' . $model->as_assistant_current_count . '</span>)';
            })
            ->addColumn('action', function ($model) {

                return view('common.table-action')->with('model', $model);
            })

            ->rawColumns(['active', 'name', 'email', 'as_assistant_count', 'field']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExpertsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expert $model)
    {
        return $model->with('user')->withCount(['matters', 'asAssistant', 'asAssistant as as_assistant_current_count' => function ($query) {
            return $query->where('matters.status', 'current');
        }])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('expert-table')
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

            Column::make('name')->title(__('app.name')),
            Column::make('email')->title(__('app.contact')),
            Column::make('field')->title(__('app.field')),
            Column::make('active')->title(__('app.active')),
            Column::make('matters_count')->title(__('app.matters'))
                ->searchable(false),
            Column::make('as_assistant_count')->title(__('app.as_assistants') . ' (' . __('app.current') . ')')
                ->searchable(false),
            Column::computed('action')
                ->title(__('app.action'))
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
        return 'Experts_' . date('YmdHis');
    }
}
