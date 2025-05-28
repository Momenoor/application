<?php

namespace App\Models;

// Add these methods to your existing Matter model

use App\Services\Money;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait MatterCommissionMethods
{
    public function calculateWorkingDays(): int
    {
        $start = Carbon::parse($this->last_action_date);
        $end = Carbon::parse($this->reported_date);

        $days = 0;
        while ($start->lte($end)) {
            if ($start->isWeekday()) {
                $days++;
            }
            $start->addDay();
        }
        return $this->commissionCompeletionPeriod = $days;
    }

    public function calculateCommission()
    {
        $settings = config('system.commission');
        $byType = $settings['by_type'];
        $byPeriod = $settings['by_period'];
        $byCount = $settings['by_count'];

        // Initialize commission values
        $this->commissionPercent = 0;
        $this->commissionAmount = 0;

        // Determine which period settings to use (default or special)
        // Add special type IDs to config or define them here
        $specialTypeIds = config('system.commission.special_type_ids', []); // e.g., [76, 217]
        $periodKey = in_array($this->type_id, $specialTypeIds) ? 'special' : 'default';
        $periodSettings = $byPeriod[$periodKey];

        // Check if this is a fixed amount type (like type 76)
        $isFixedAmountType = isset($byType[$this->type_id]) && is_array($byType[$this->type_id]);

        if ($isFixedAmountType) {
            // For fixed amount types, just return the fixed amount without any bonus
            $this->commissionAmount = $this->calculateTypeBasedCommission($byType[$this->type_id]);
            $this->commissionPercent = 0; // No percentage for fixed amounts

            return $this->commissionAmount;
        }

        // Type-based percentage commission
        if (isset($byType[$this->type_id])) {
            $this->commissionPercent = $byType[$this->type_id];
        } else {
            // Period-based commission calculation
            $this->commissionPercent = $this->calculatePeriodBasedCommission($periodSettings);
        }

        // Count-based commission calculation (adds extra percentage)
        $count = $this->calculateCasesCount();
        $extraPercent = $this->calculateCountBasedCommission($byCount, $count);
        $this->commissionPercent += $extraPercent;

        // Calculate final commission amount
        $this->commissionAmount = ($this->commissionPercent / 100) * $this->claimsWithOutVat->sum('amount');
        return $this->commissionAmount;
    }

    private function calculateTypeBasedCommission($typeSetting): float
    {
        if (is_array($typeSetting)) {
            // Fixed amount based on expert involvement
            $notesText = $this->notes->pluck('text')->implode(' / / / / ');
            // Return the fixed amount directly (200 or 400)
            return str_contains($notesText, 'رضا') ? $typeSetting['with_expert'] : $typeSetting['without_expert'];
        } else {
            // This shouldn't be called for percentage types in the new flow
            // But keeping for backward compatibility
            return ($typeSetting / 100) * $this->claimsWithOutVat->sum('amount');
        }
    }

    private function calculatePeriodBasedCommission(array $periods): int
    {
        $completionPeriod = $this->calculateWorkingDays();

        foreach ($periods as $period) {
            // Handle periods without start (catch-all)
            if (!isset($period['start'])) {
                return $period['percent'];
            }

            // Check if completion period falls within this range
            if ($completionPeriod >= $period['start'] && $completionPeriod <= $period['end']) {
                return $period['percent'];
            }
        }

        // Return last period's percent if no match found
        return end($periods)['percent'];
    }

    private function calculateCasesCount(): int
    {
        // Get config start and end days
        $startDay = config('system.commission.start_day', 26);
        $endDay = config('system.commission.end_day', 25);

        // Get expert_id from matter_expert table - try both singular and plural table names
        $expertRecord = \DB::table('matter_expert')
            ->where('matter_id', $this->id)
            ->where('type', 'assistant')
            ->first();

        if (!$expertRecord) {
            // Try plural table name
            $expertRecord = \DB::table('matter_experts')
                ->where('matter_id', $this->id)
                ->where('type', 'assistant')
                ->first();
        }

        if (!$expertRecord) {
            \Log::warning('No expert found for matter', [
                'matter_id' => $this->id,
                'checking_tables' => ['matter_expert', 'matter_experts']
            ]);
            return 0;
        }

        $expert_id = $expertRecord->expert_id;
        $reportedDate = Carbon::parse($this->reported_date);

        // Determine the commission period for this case
        if ($reportedDate->day >= $startDay) {
            $periodStart = $reportedDate->copy()->day($startDay);
            $periodEnd = $reportedDate->copy()->addMonth()->day($endDay);
        } else {
            $periodStart = $reportedDate->copy()->subMonth()->day($startDay);
            $periodEnd = $reportedDate->copy()->day($endDay);
        }

        // Count cases for this expert in this specific period only
        // Try both table names for the relationship
        $count = self::whereBetween('reported_date', [$periodStart, $periodEnd])
            ->where(function($query) use ($expert_id) {
                $query->whereHas('matter_experts', function($q) use ($expert_id) {
                    $q->where('expert_id', $expert_id)
                        ->where('type', 'assistant');
                })
                    ->orWhereHas('matterExperts', function($q) use ($expert_id) {
                        $q->where('expert_id', $expert_id)
                            ->where('type', 'assistant');
                    });
            })
            ->count();

        \Log::info('Monthly commission count', [
            'case_id' => $this->id,
            'expert_id' => $expert_id,
            'period' => $periodStart->format('Y-m-d') . ' to ' . $periodEnd->format('Y-m-d'),
            'count' => $count,
        ]);

        return $count;
    }

    private function calculateCountBasedCommission(array $countSettings, int $count): float
    {
        // Handle explicit count values
        if (isset($countSettings[$count])) {
            return $countSettings[$count];
        }

        // Handle "more_than_X" cases
        $maxDefinedCount = max(array_filter(array_keys($countSettings), 'is_numeric'));

        if ($count > $maxDefinedCount && isset($countSettings['more_than_' . $maxDefinedCount])) {
            return $countSettings['more_than_' . $maxDefinedCount];
        }

        // No extra commission for counts below threshold
        return 0;
    }

    public function getCommissionAttribute(): array
    {
        $this->calculateCommission();

        // Get count for debugging
        $count = $this->calculateCasesCount();
        $countBonus = $this->calculateCountBasedCommission(config('system.commission.by_count'), $count);

        return [
            'amount' => app(Money::class)->getFormattedNumber($this->commissionAmount),
            'percent' => $this->commissionPercent,
            'period' => $this->commissionCompeletionPeriod,
            'count' => $count, // Add count for debugging
            'count_bonus' => $countBonus, // Add bonus percentage for debugging
        ];
    }

    // Add this method to see commission breakdown by period
    public static function getCommissionSummaryByPeriod($startDate, $endDate)
    {
        $startDay = config('system.commission.start_day', 26);
        $endDay = config('system.commission.end_day', 25);

        // Load cases without the relationship first
        $cases = self::whereBetween('reported_date', [$startDate, $endDate])
            ->orderBy('reported_date')
            ->get();

        $summary = [];

        foreach ($cases as $case) {
            // Try to get expert from database directly
            $expertRecord = \DB::table('matter_expert')
                ->where('matter_id', $case->id)
                ->where('type', 'assistant')
                ->first();

            if (!$expertRecord) {
                // Try plural table name
                $expertRecord = \DB::table('matter_experts')
                    ->where('matter_id', $case->id)
                    ->where('type', 'assistant')
                    ->first();
            }

            if (!$expertRecord) {
                \Log::warning('No expert found in summary', ['case_id' => $case->id]);
                continue;
            }

            $expert_id = $expertRecord->expert_id;
            $reportedDate = Carbon::parse($case->reported_date);

            // Determine period
            if ($reportedDate->day >= $startDay) {
                $periodStart = $reportedDate->copy()->day($startDay);
                $periodEnd = $reportedDate->copy()->addMonth()->day($endDay);
            } else {
                $periodStart = $reportedDate->copy()->subMonth()->day($startDay);
                $periodEnd = $reportedDate->copy()->day($endDay);
            }

            $periodKey = $periodStart->format('Y-m-d') . ' to ' . $periodEnd->format('Y-m-d');

            // Count cases for this expert in this period using direct SQL
            $count = \DB::table('matters')
                ->join('matter_expert', 'matters.id', '=', 'matter_expert.matter_id')
                ->whereBetween('matters.reported_date', [$periodStart, $periodEnd])
                ->where('matter_expert.expert_id', $expert_id)
                ->where('matter_expert.type', 'assistant')
                ->count();

            if ($count == 0) {
                // Try plural table name
                $count = \DB::table('matters')
                    ->join('matter_experts', 'matters.id', '=', 'matter_experts.matter_id')
                    ->whereBetween('matters.reported_date', [$periodStart, $periodEnd])
                    ->where('matter_experts.expert_id', $expert_id)
                    ->where('matter_experts.type', 'assistant')
                    ->count();
            }

            $case->calculateCommission();

            $summary[] = [
                'case_id' => $case->id,
                'case_number' => $case->number ?? $case->id,
                'reported_date' => $case->reported_date,
                'expert_id' => $expert_id,
                'period' => $periodKey,
                'count_in_period' => $count,
                'commission_percent' => $case->commissionPercent,
                'commission_amount' => $case->commissionAmount,
            ];
        }

        return $summary;
    }

    // Add this method to help debug the commission calculation
    public function getCommissionDebugInfo(): array
    {
        $settings = config('system.commission');
        $count = $this->calculateCasesCount();

        // Get assistant info for debugging
        $assistant = $this->assistants()->first();
        $assistantData = null;
        if ($assistant) {
            $assistantData = [
                'attributes' => $assistant->getAttributes(),
                'relations' => array_keys($assistant->getRelations()),
            ];
        }

        // Calculate date range
        $filterStartDate = request()->input('start_date');
        if ($filterStartDate) {
            $startCountDate = Carbon::parse($filterStartDate);
            $endCountDate = $startCountDate->copy()->addMonth()->subDay();
        } else {
            $completionDate = Carbon::parse($this->reported_date);
            $startDay = config('system.commission.start_day', 26);
            $endDay = config('system.commission.end_day', 25);

            if ($completionDate->day >= $startDay) {
                $startCountDate = $completionDate->copy()->day($startDay);
                $endCountDate = $completionDate->copy()->addMonth()->day($endDay);
            } else {
                $startCountDate = $completionDate->copy()->subMonth()->day($startDay);
                $endCountDate = $completionDate->copy()->day($endDay);
            }
        }

        return [
            'case_id' => $this->id,
            'type_id' => $this->type_id,
            'assistant_data' => $assistantData,
            'reported_date' => $this->reported_date,
            'count_period' => [
                'start' => $startCountDate->toDateString(),
                'end' => $endCountDate->toDateString(),
            ],
            'cases_count' => $count,
            'working_days' => $this->calculateWorkingDays(),
            'base_percent' => $this->commissionPercent - $this->calculateCountBasedCommission($settings['by_count'], $count),
            'count_bonus' => $this->calculateCountBasedCommission($settings['by_count'], $count),
            'total_percent' => $this->commissionPercent,
            'commission_amount' => $this->commissionAmount,
        ];
    }
}


