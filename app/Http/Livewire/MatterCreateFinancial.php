<?php

namespace App\Http\Livewire;

use App\Services\NumberFormatterService;
use Illuminate\Support\Arr;
use Livewire\Component;

class MatterCreateFinancial extends Component
{
    // Commission Vars
    public $hasMarketingCommission;
    public $hasExternalCommission;
    public $selectedMarketingRep;
    public $i, $n;
    public $thirdparty = [];
    public $selectedThirdParty;
    public $showModal;
    public $thirdPartiesList = [];

    protected $listeners = [
        'selectThirpParty'
    ];

    // Claims Vars
    public $claimsTypes = [
        'main' => [
            'id' => 1,
            'name' => 'Main',
            'color' => 'success',
            'display' => true,
        ],
        'additional' => [
            'id' => 2,
            'name' => 'Additional',
            'color' => 'secondary',
            'display' => true,
        ],
        'penality' => [
            'id' => 3,
            'name' => 'Penality',
            'color' => 'danger',
            'display' => true,
        ],
        'recurring' => [
            'id' => 4,
            'name' => 'Recurring',
            'color' => 'warning',
            'display' => false,
            'values' => [
                'no' => [
                    'name' => 'No',
                    'color' => 'danger'
                ],
                'monthly' => [
                    'name' => 'Monthly',
                    'color' => 'success'
                ],
                'quartely' => [
                    'name' => 'Quartely',
                    'color' => 'primary'
                ],
                'half-yearly' => [
                    'name' => 'Half-yearly',
                    'color' => 'warning'
                ],
                'yearly' => [
                    'name' => 'Yearly',
                    'color' => 'info'
                ],
            ]
        ],
        'vat' => [
            'id' => 5,
            'name' => 'VAT',
            'color' => 'dark',
            'display' => false,
        ],
        'office_share' => [
            'id' => 6,
            'name' => 'Office Share',
            'color' => 'warning',
            'display' => true,
        ],
        'commission' => [
            'id' => 6,
            'name' => 'Commission',
            'color' => 'primary',
            'display' => false,
        ],
    ];
    public $claim = [
        'type' => '',
        'amount' => '',
        'recurring' => '',
        'taxable' => false,
    ];
    public $claims = [];



    public function render()
    {
        return view('pages.matters.form.partials.financial');
    }

    // Commission Functions Start
    public function showModal()
    {
        $this->showModal = true;
    }

    public function storeThirdParty()
    {

        $validatedData = $this->validate([
            'thirdparty.name' => 'required|min:6',
            'thirdparty.email' => 'required|email',
            'thirdparty.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);
        $this->i++;
        $this->thirdPartiesList = Arr::add($this->thirdPartiesList, $this->i, $validatedData['thirdparty']['name']);
        $this->resetThirdPartyForm();
    }

    public function resetThirdPartyForm()
    {
        $this->showModal = false;
        $this->thirdparty = [];
    }

    public function selectThirpParty($data)
    {
        $this->selectedThirdParty = $data;
    }

    // Commission Functions End

    //Claims Functions Start

    public function addClaim()
    {
        $this->n++;
        $validatedData = $this->validate([
            'claim.amount' => 'required',
            'claim.type' => 'required',
            'claim.recurring' => 'required',
        ]);

        if (key_exists('taxable', $this->claim) && $this->claim['taxable']) {
            $taxableData = [
                'type' => $this->claimsTypes['vat'],
                'amount' => NumberFormatterService::getFormattedNumber($validatedData['claim']['amount'] * .05),
                'recurring' => $this->claimsTypes['recurring']['values'][$validatedData['claim']['recurring']]
            ];
            $this->claims[$this->n] = $taxableData;
            $this->n++;
        }

        // this to be made in model accessor while making database
        $validatedData['claim']['amount'] = NumberFormatterService::getFormattedNumber(
            $validatedData['claim']['amount']
        );
        //end

        $validatedData['claim']['type'] = $this->claimsTypes[$validatedData['claim']['type']];

        $validatedData['claim']['recurring'] = $this->claimsTypes['recurring']['values'][$validatedData['claim']['recurring']];

        $this->claims[$this->n] = $validatedData['claim'];

        $this->claim = [];
    }

    public function removeClaim($key)
    {
        unset($this->claims[$key]);
    }

    //Claims Functions End

}
