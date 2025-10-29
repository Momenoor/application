<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class MattersExport implements FromArray, WithHeadings, ShouldAutoSize, WithStrictNullComparison, ShouldQueue
{
    use Exportable;

    /**
     * Final flattened rows exactly as built in the controller.
     *
     * Each row should be an ordered associative array with the keys matching your desired columns.
     * Example:
     * [
     *   'Case ID' => 123,
     *   'Case Number' => '2025/00123',
     *   'Expert' => 'John',
     *   'Assistant' => 'Sara',
     *   'Working Days' => 14,
     *   'Commission %' => 5,
     *   'Commission Amount' => 200.00,
     *   ...
     * ]
     *
     * @var array<int, array<string, mixed>>
     */
    protected array $rows;

    /**
     * @param array<int, array<string, mixed>> $rows
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /** Export the exact dataset */
    public function array(): array
    {
        return $this->rows;
    }

    /** Use the keys of the first row as headings (keeps export == view) */
    public function headings(): array
    {
        return empty($this->rows) ? [] : array_keys($this->rows[0]);
    }
}
