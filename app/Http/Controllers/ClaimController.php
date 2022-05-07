<?php

namespace App\Http\Controllers;

use App\Events\MatterClaimChanged;
use App\Models\Claim;
use App\Models\Matter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ClaimController extends Controller
{


    public function addFromMatter(Request $request, Matter $matter)
    {
        $claim = [];
        $validated = $request->validate([
            'claim.amount' => 'required',
            'claim.type' => 'required',
            'claim.recurring' => 'required',
        ]);
        data_set($claim, 'main', $validated['claim']);
        if ($request->has('taxable')) {
            $vatRate = floatval(config('system.vat.rate'));
            $vatClaim = [
                'amount' => floatval((data_get($claim, 'main.amount') * $vatRate) / 100),
                'type' => 'vat',
                'recurring' => (data_get($claim, 'main.recurring')),
            ];
            data_set($claim, 'vat', $vatClaim);
        }

        $mainExperts = config('system.experts.main');

        if (!in_array($matter->expert_id, $mainExperts) && data_get($validated, 'claim.type') != Claim::OFFICE_SHARE) {
            $officeShareRate = config('system.experts.office_share.rate');
            $officeShareClaim = [
                'amount' => floatval((data_get($claim, 'main.amount') * $officeShareRate) / 100),
                'type' => 'office_share',
                'recurring' => (data_get($claim, 'main.recurring')),
            ];
            data_set($claim, 'office_share', $officeShareClaim);
        }

        $matter->claims()->createMany($claim);

        MatterClaimChanged::dispatch($matter);

        return redirect()->route('matter.show', $matter)->withToastSuccess(__('app.claim-added-successfully'));
    }

    public function destroy(Claim $claim)
    {
        abort_unless(auth()->user()->can('claim-delete'), 403);
        $matter = $claim->matter;
        $claim->cashes()->delete();
        $claim->delete();
        MatterClaimChanged::dispatch($matter);
        return redirect()->route('matter.edit', $matter)->withToastSuccess(__('app.claim-deleted-successfully'));
    }
}
