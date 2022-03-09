<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MatterCreatePartyAddParty extends Component
{
    public $partyTypes;
    public $partyItem;
    public $subPartyFormItems = [];
    public $i = 1;
    public $parentIndex;
    public $selectedSubPartyName;

    public function mount($partyTypes, $parentIndex, $partyItem)
    {
        $this->parentIndex = $parentIndex;
        $this->partyTypes = $partyTypes;
        $this->partyItem = $partyItem;
    }

    public function render()
    {
        return view('pages.matters.form.partials.add-party-to-party');
    }

    public function addSubPartyItem($index): void
    {
        $this->partyItem['subPartyFormItems'][$this->i] = [];
        $this->i++;
    }

    public function removeSubPartyItem(int $index, $subIndex = null): void
    {
        unset($this->partyItem['subPartyFormItems'][$subIndex]);
    }
    public function removeAllSubPartyItem(int $index): void
    {
        unset($this->partyItem['subPartyFormItems']);
        $this->partyItem['subPartyFormItems'] = [];
    }

    public function selectSubPartyName($index, $value)
    {
        $this->selectedSubPartyName[$index] = $value;
    }
}
