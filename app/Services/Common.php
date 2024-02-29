<?php

namespace App\Services;

use App\Models\Cash;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Type;

class Common
{

    /**
     * @return array
     */
    public function fetchDataForForm(): array
    {
        $experts = Expert::join('accounts', 'accounts.id', 'experts.account_id')->whereIn('category', [Expert::MAIN, Expert::CERTIFIED])->pluck('accounts.name', 'experts.id');
        $assistants = Expert::join('accounts', 'accounts.id', 'experts.account_id')->whereIn('category', [Expert::MAIN, Expert::CERTIFIED, Expert::ASSISTANT])->pluck('accounts.name', 'experts.id');
        $types = Type::pluck('name', 'id');
        $courts = Court::pluck('name', 'id');
        $claimsStatus = [
            Cash::OVERPAID,
            Cash::PAID,
            Cash::UNPAID,
            Cash::PARTIAL,
        ];
        return array($experts, $assistants, $types, $courts, $claimsStatus);
    }
}
