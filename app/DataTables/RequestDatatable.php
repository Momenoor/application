<?php

namespace App\DataTables;

use App\Models\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RequestDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('matter', function ($model) {

                return '<a target="_blank" href="' . route('matter.edit', $model->matter) . '">'
                    . $model->matter->year . ' / ' . $model->matter->number . '</a>';
            })
            ->filterColumn('matter', function ($query, $keyword) {
                if (Str::contains($keyword, '/')) {
                    $keywords = Str::of($keyword)->explode('/');
                    $query->whereIn('matters.number', $keywords)
                        ->whereIn('matters.year', $keywords);
                }
                $query->orWhere('matters.number', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.year', 'like', '%' . $keyword . '%')
                    ->orWhere('matters.status', 'like', '%' . $keyword . '%');
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })
            ->editColumn('approved_by', function ($model) {
                return $model->approvedBy?->name;
            })
            ->editColumn('approved_at', function ($model) {
                return $model->approved_at?->diffForHumans();
            })
            ->editColumn('request_by', function ($model) {

                return $model->requestBy->name;
            })
            ->rawColumns(['matter', 'action'])
            ->addColumn('action', function ($model) {
                return view('common.request-actions', compact('model'));

            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Request $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Request $model)
    {
        return $model->with(['matter']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('request-table')
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
            Column::make('matter')
                ->searchable()
                ->title(__('app.matter'))->orderable(false),
            Column::make('created_at')->title('تاريخ الطلب'),
            Column::make('request_by')->title('مقدم الطلب'),
            Column::make('status')->title('الحالة'),
            Column::make('type')->title('النوع'),
            Column::make('approved_by')->title('بواسطة'),
            Column::make('approved_at')->title('تاريخ الموافقة'),
            Column::make('comment')->title('البيان'),
            Column::computed('action')
                ->title(__('app.action'))
                ->exportable(false)
                ->printable(false)
                ->width(150)
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
        return 'Requests_' . date('YmdHis');
    }
}
