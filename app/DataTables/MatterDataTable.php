<?php

namespace App\DataTables;

use App\Models\Matter;
use App\Services\NumberFormatterService;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
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
                return $model->year . '/' . $model->number;
            })
            ->editColumn('dates', function ($model) {
                return '<div class="position-relative">
                                ' . $model->nextSessionDateProcedure->last()->datetime->format('Y-d-m') . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->receivedDateProcedure->first()->datetime->format('Y-d-m') . '</div>
                        </div>';
            })
            ->editColumn('expert_id', function ($model) {
                return '<div class="position-relative">
                                ' . $model->expert->name . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->assistants->first()->name . '</div>
                        </div>';
            })
            ->editColumn('court_id', function ($model) {
                return '<div class="position-relative">
                                ' . $model->court->name . '
                            <div class="fs-7 text-muted fw-bolder">' . $model->type->name . '</div>
                        </div>';
            })
            ->editColumn('parties', function ($model) {
                return '<div class="position-relative">
                                ' . \Str::of($model->plaintiffs->first()->name)->limit(30) . '
                            <div class="text-danger">' . \Str::of($model->defendants->first()->name)->limit(30)  . '</div>
                        </div>';
            })
            ->editColumn('claims', function ($model) {
                return app(NumberFormatterService::class)->getFormattedNumber($model->claims_sum_amount);
            })
            ->rawColumns(['expert_id', 'court_id', 'parties', 'dates'])
            ->addColumn('action', function ($model) {
                return view('common.table-action')->with('model' ,$model);
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
        return $model->with([
            'court',
            'expert',
            'assistants',
            'defendants',
            'plaintiffs',
            'type',
            'receivedDateProcedure' => function ($query) {
                return $query->where('type', 'received_date');
            },
            'nextSessionDateProcedure' => function ($query) {
                return $query->where('type', 'next_session_date');
            }
        ])->withSum(
            [
                'claims as claims_sum_amount' => function ($query) {
                    $query->whereIn('claims.type', ['main', 'additional']);
                }
            ],
            'amount'
        )->newQuery();
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
            ->parameters(['scrollX' => true])
            ->buttons(
                Button::make('create'),
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
            Column::make('number')->title('No/Year'),
            Column::make('expert_id')->title('Expert/Assistant'),
            Column::make('court_id')->title('Court/Type'),
            Column::make('parties')->title('Parties'),
            Column::make('dates')->title('Session/Receive'),
            Column::make('claims')->name('claims.amount')->title('Claims')->class('text-end'),
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
}
