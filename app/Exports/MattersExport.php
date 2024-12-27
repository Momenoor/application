<?php

namespace App\Exports;

use App\Models\Matter;
use App\Services\MatterService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class MattersExport implements FromQuery, WithStrictNullComparison, ShouldQueue, WithHeadings, WithMapping
{
    use Exportable;


    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        return (new MatterService())->setFilters($this->request)->getForExcel();
    }

    public function headings(): array
    {
        $heading = [

            __('app.no'),
            __('app.year'),
            __('app.expert'),
            __('app.court'),
            __('app.type'),
            __('app.assistant'),
            __('app.plaintiff'),
            __('app.defendant'),
            __('app.status'),
            __('app.received_date'),
            __('app.last_action_date'),
            __('app.reported_date'),
            __('app.submitted_date'),
            __('app.claim_status'),
            __('app.claim_amount'),
            __('app.claim_dues'),
            __('app.claim_collected'),
            __('app.notes'),

        ];

        if ($this->request->input('for_commission') == 'yes') {
            $heading = array_merge($heading, [
                __('app.commission_period'),
                __('app.commission_percent'),
                __('app.commission_amount'),
            ]);
        }

        return $heading;
    }

    public function map($row): array
    {

        $result = [
            $row->number,
            $row->year,
            optional($row->expert)->name,
            optional($row->court)->name,
            optional($row->type)->name,
            optional($row->assistant)->name,
            optional($row->plaintiff)->name,
            optional($row->defendant)->name,
            __('app.' . $row->status),
            optional($row->received_date)->format('Y-m-d'),
            optional($row->last_action_date)->format('Y-m-d'),
            optional($row->reported_date)->format('Y-m-d'),
            optional($row->submitted_date)->format('Y-m-d'),
            __('app.' . $row->claim_status),
            $row->claims_sum_amount,
            $row->dueAmount(),
            $row->cash_sum_amount,
            $row->notes()->implode('text', ' / / / / '),
        ];

        if ($this->request->input('for_commission') == 'yes') {
            $result = array_merge($result, [
                $row->commission['period'],
                $row->commission['percent'],
                $row->commission['amount'],
            ]);
        }

        return $result;
    }
}
