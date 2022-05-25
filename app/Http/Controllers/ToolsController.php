<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cash;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\User;
use App\Services\ClaimCollectionStatus;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ToolsController extends Controller
{

    private $tables = [
        'types' => [
            'Matter' => 'type_id'
        ],
        'courts' => [
            'Matter' => 'court_id',
        ],
        'experts' => [
            'Matter' => 'expert_id',
            'MatterExpert' => 'expert_id',
        ],
        'parties' => [
            'MatterParty' => [
                'party_id',
                'parent_id',
            ],
        ],
    ];

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

    public function removeDuplicatedForm()
    {
        $tables = array_keys($this->tables);
        return view('pages.tools.remove-duplicated-form', compact('tables'));
    }

    public function removeDuplicatedRecord(Request $request)
    {
        $n = 0;
        $tableName = \Str::of($request->input('tableName'))->singular()->ucfirst();
        $model = "App\\Models\\" . $tableName;
        $duplicated = $model::select('name', \DB::raw('COUNT(name) as duplicated'))->groupBy('name')->having('duplicated', '>', 1)->get();
        foreach ($duplicated as $duplicate) {
            $first = $model::where('name', $duplicate->name)->first();
            $otherIds = $model::where('name', $duplicate->name)->where('id', '!=', $first->id)->get();

            $otherIds->each(function ($item) use ($request, $first) {
                $relationArray = $this->tables[$request->get('tableName')];
                foreach ($relationArray as $table => $column) {
                    if (is_string($column)) {
                        $column = [$column];
                    }
                    foreach ($column as $col) {
                        $relatedModel = $model = "App\\Models\\" . $table;
                        $relatedModel::where($col, $item->id)->update([$col => $first->id]);
                    }
                }
            });
            $model::where('name', $duplicate->name)->where('id', '!=', $first->id)->delete();
            $n++;
        }

        return redirect()->to(route('tools.remove-duplicated'))->withToastSuccess(__('app.deuplicated-rows-deleted, :count effected-rows', ['count' => $n]));
    }

    public function fixAccountsData()
    {
        $experts = Expert::all();
        $users = User::all();

        foreach ($experts as $expert) {
            $account = new Account([
                'name' => $expert->name,
                'phone' => $expert->phone,
                'email' => $expert->email,
            ]);
            $account->save();
            $expert->user()->associate($account);

            $expert->account()->save($account);
        }

        return redirect(route('matter.index'))->withToastSuccess('account added successfully');
    }
}
