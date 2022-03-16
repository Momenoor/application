<?php

namespace App\Http\Livewire;

use App\Enums\MatterCommissioning;
use Livewire\Component;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
use App\Models\User;
use App\Services\NumberFormatterService;

class MatterCreateForm extends Component
{

    // Main Model Definations
    public $matter;
    public $parties = [];
    public $otherParties = [];
    public $hasMarketingCommission;
    public $hasExternalCommission;
    public $claims = [];
    public $claim;

    // Indexes for clonable fields
    public $i = 1;
    public $n = 1;
    public $x = 1;

    // predefined data passed to the form for population
    public $partyTypes;
    public $claimsTypes;
    public $expertsList;
    public $courtsList;
    public $typesList;
    public $partiesList;
    public $advocatesList;
    public $committeesList;
    public $marketersList;
    public $externalMarketersList;
    public $committeeChoiceValue;


    // Events Listners
    protected $listeners = [
        'showAddSubPartyButton'
    ];

    public function mount()
    {
        $this->expertsList = Expert::whereIn('category', ['main', 'certified'])->get(['id', 'name'])->toArray();
        $this->courtsList = Court::get(['id', 'name'])->toArray();
        $this->typesList = Type::get(['id', 'name'])->toArray();
        $this->advocatesList = Party::whereIn('type', ['office', 'advocate', 'advisor'])->get(['id', 'name'])->toArray();
        $this->externalMarketersList = Party::where('type', 'external_marketer')->get(['id', 'name'])->toArray();
        $this->committeesList = Expert::CommitteesList()->get(['id', 'name'])->toArray();
        $this->marketersList = User::where('category', 'staff')->get(['id', 'display_name'])->toArray();
        $this->committeeChoiceValue = Matter::COMMITTEE;
        $this->partyTypes = config('system.parties.type');
        $this->claimsTypes = config('system.claims');
        $this->addParty();
    }
    public function render()
    {
        return view('livewire.matter-create-form');
    }

    public function addParty()
    {
        $this->parties[$this->i] = [
            'showAddSubPartyButton' => false,
            'subParties' => [],
        ];
        $this->i++;
    }

    public function showAddSubPartyButton($index, $value)
    {
        $this->parties[$index]['showAddSubPartyButton'] = $this->partyTypes[$value]['showAddPartyButton'];
    }

    public function removeParty($index)
    {
        unset($this->parties[$index]);
    }

    public function addSubParty($parentIndex)
    {
        $this->parties[$parentIndex]['subParties'][$this->n] = null;
        $this->n++;
    }

    public function removeSubParty($parentIndex, $index)
    {
        unset($this->parties[$parentIndex]['subParties'][$index]);
    }

    public function removeAllSubPartyItem($parentIndex)
    {
        $this->parties[$parentIndex]['subParties'] = [];
    }

    public function addClaim()
    {
        $this->x++;

        $validatedData = $this->validate([
            'claim.amount' => 'required',
            'claim.type' => 'required',
            'claim.recurring' => 'required',
        ]);

        if (key_exists('taxable', $this->claim) && $this->claim['taxable']) {
            $vatRate = floatval(config('system.vat.rate'));
            $taxableData = [
                'type' => $this->claimsTypes['vat'],
                'amount' => NumberFormatterService::getFormattedNumber($validatedData['claim']['amount'] * $vatRate / 100),
                'recurring' => $this->claimsTypes['recurring']['values'][$validatedData['claim']['recurring']]
            ];
            $this->claims[$this->n] = $taxableData;
            $this->n++;
        }

        $this->claims[$this->n] = [
            'amount' => NumberFormatterService::getFormattedNumber($validatedData['claim']['amount']),
            'type' => $this->claimsTypes[$validatedData['claim']['type']],
            'recurring' => $this->claimsTypes['recurring']['values'][$validatedData['claim']['recurring']]
        ];

        $this->n++;
        $this->claim = [];
    }

    public function removeClaim($index)
    {
        unset($this->claims[$index]);
    }
}
