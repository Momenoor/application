<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Livewire\Component;

class MatterCreateParty extends Component
{
    public $partyTypes;
    public $i = 1;
    public $n = 1;
    public $partiesFormItems = [];
    public $selectedPartyType = [];
    public $selectedSubPartyName = [];
    public $partTypesConfig;


    protected $listeners = [
        'selectPartyType',
        'selectSubPartyName'
    ];

    public function mount($partyTypes): void
    {
        $this->partyTypes = $partyTypes;
        $this->partiesFormItems[$this->i] = ['subPartyFormItems' => [], 'showAddSubPartyButton' => false];
        $this->partTypesConfig = config('system.party.type');
    }

    public function render()
    {
        return view('pages.matters.form.partials.add-party');
    }

    public function addPartyFormItem(): void
    {
        $this->i++;
        $this->partiesFormItems[$this->i] = ['subPartyFormItems' => [], 'showAddSubPartyButton' => false];
    }

    public function removePartyFormItem($index): void
    {
        unset($this->partiesFormItems[$index]);
    }

    public function selectPartyType($index, $value): void
    {
        $this->selectedPartyType[$index]['type'] = $value;
        $this->partiesFormItems[$index]['showAddSubPartyButton'] = $this->partTypesConfig[$value]['showAddPartyButton'];
    }

    public function addSubPartyItem($index): void
    {
        $this->n++;
        $this->partiesFormItems[$index]['subPartyFormItems'][$this->n] = [];
    }

    public function removeSubPartyItem(int $index, $subIndex = null): void
    {
        unset($this->partiesFormItems[$index]['subPartyFormItems'][$subIndex]);
    }
    public function removeAllSubPartyItem(int $index): void
    {
        $this->partiesFormItems[$index]['subPartyFormItems'] = [];
    }

    public function selectSubPartyName($parentIndex, $index, $value)
    {
        $this->selectedSubPartyName[$parentIndex][$index] = $value;
    }
}
