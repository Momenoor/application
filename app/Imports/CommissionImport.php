<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CommissionImport implements ToCollection, WithStartRow
{
    public $data;

    public function __construct()
    {
        $this->data = collect();
    }

    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        ;
        $collection->map(function ($item) {

            $mapped = [
                'name' => $item[0],
                'number' => $item[1],
                'last_action' => (!empty($item[4]) and !is_string($item[4])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[4]) : '-',
                'reported' => (!empty($item[5]) and !is_string($item[5])) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item[5]) : '-',
                'amount' => $item[8],
            ];

            $this->data->push($mapped);
        });
        return $this->data;
    }
}
