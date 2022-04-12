<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Matter;
use App\Services\ClaimCollectionStatus;
use Illuminate\Http\Request;
use PDO;

class ToolsController extends Controller
{
    public function fixClaimsStatus()
    {
        $matters = Matter::with(['claims', 'cashes'])->get();
        $matters->each(function ($matter) {
            $claimCollectionStatus = ClaimCollectionStatus::make($matter);
            $matter->claim_status = $claimCollectionStatus->getClaimStatus();
            $matter->save();

            $matter->claims->each(function ($claim) {
                if ($claim->matter->claim_status == Cash::PAID) {
                    $claim->status = Cash::PAID;
                } else {
                    $amount = $claim->amount;
                    $collectedAmount = $claim->cashes->sum('amount');
                    $claim->status = $this->claimCollectionStatus($amount, $collectedAmount);
                }
                $claim->save();
            });
        });
        return redirect()->to(route('matter.index'))->withSuccess('Matter Claim and Claim Status fixed.');
    }

    public function fixClaimOverPaid()
    {
        $matters = Matter::with(['claims', 'cashes'])->get();
        $matters->each(function ($matter) {
            $service = ClaimCollectionStatus::make($matter);
            if ($matter->isOverPaid()) {
                if ($matter->isPrivate()) {
                    $dues = $service->getSumDueClaims(false);
                    $total = $service->getSumTotalClaims(false);
                    if (($dues * -1) == ($total * 0.25)) {
                        $matter->claims()->create([
                            'amount' => (-1 * $dues),
                            'type' => 'office_share',
                            'recurring' => 'none',
                        ]);
                    }
                } elseif ($matter->assistants->first() == 10) {
                }
            }
        });

        return redirect()->to(route('matter.index'))->withSuccess('Claim Over Paid fixed.');
    }

    protected function claimCollectionStatus($amount, $collected)
    {
        if ($collected > $amount) {

            return Cash::OVERPAID;
        }

        if ($collected == $amount) {
            return Cash::PAID;
        }

        if ($collected > 0 && $collected < $amount) {
            return Cash::PARTIAL;
        }

        if ($collected <= 0) {
            return Cash::UNPAID;
        }
    }
}
