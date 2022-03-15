<?php

namespace App\Http\Livewire;

use App\Services\NumberFormatterService;
use Illuminate\Http\Request;
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
    public $claimsTypes = [];
    public $claim = [
        'type' => '',
        'amount' => '',
        'recurring' => '',
        'taxable' => false,
        'color' => '',
    ];
    public $claims = [];
    public $marketers = [];

    public function mount($marketers)
    {
        $this->claimsTypes = config('system.claims');
        $this->marketers = $marketers;
    }

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
