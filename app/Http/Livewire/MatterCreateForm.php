<?php

namespace App\Http\Livewire;

use App\Jobs\CreateMatter;
use Livewire\Component;
use App\Models\Court;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Type;
use App\Models\User;
use App\Services\NumberFormatterService;
use Illuminate\Foundation\Bus\DispatchesJobs;

class MatterCreateForm extends Component
{

    use DispatchesJobs;


    // Main Model Definations
    public $matter;
    public $parties = [];
    public $otherParties = [];
    public $hasMarketingCommission;
    public $hasExternalCommission;
    public $claims = [];
    public $claim;
    public $isNew = true;


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


    protected $rules = [
        'matter.year' => 'required|min:4|max:4|date_format:Y',
        'matter.number' => 'required',
        'matter.received_date' => 'required|date',
        'matter.next_session_date' => 'required|date',
        'matter.commissioning' => 'required',
        'matter.court_id' => 'required|exists:courts,id',
        'matter.type_id' => 'required|exists:types,id',
        'matter.expert_id' => 'required|exists:experts,id',
        'matter.committee' => 'required_if:matter.commissioning,committee',
        'parties.*.type' => 'required',
        'parties.*.name' => 'required',
        'parties.*.phone' => 'numeric',
        'parties.*.email' => 'email',
        'parties.*.subParties.*' => 'required',
        'matter.external_commission_percent' => 'required_if:hasExternalCommission,1|numeric',
        'otherParties.external_markter.id' => 'required_if:hasExternalCommission,1',
        'otherParties.marketer.id' => 'required_if:hasMarketingCommission,1',
    ];

    protected $messages = [
        'matter.year.required' => 'The :attribute cannot be empty.',
        'email.email' => 'The :attribute format is not valid.',
    ];

    protected $validationAttributes = [
        'matter.year' => 'Year',
        'matter.number' => 'Number',
        'matter.received_date' => 'Receive Date',
        'matter.next_session_date' => 'Next Session',
        'matter.commissioning' => 'Commissioning',
        'matter.court_id' => 'Court',
        'matter.type_id' => 'Type',
        'matter.expert_id' => 'Expert',
        'matter.committee' => 'Committee',
        'parties.*.type' => 'Party Type',
        'parties.*.name' => 'Party Name',
        'parties.*.phone' => 'Party Phone',
        'parties.*.email' => 'Party Email',
        'parties.*.subParties.*' => 'Advocate',
        'matter.external_commission_percent' => 'Commission Rate',
        'otherParties.external_markter.id' => 'External Marketer',
        'otherParties.marketer.id' => 'Marketer',
    ];

    public function mount($id)
    {
        if ($id) {
            $matter = Matter::findOrFail($id);
            if ($matter) {
                $this->matter = $matter;
                $this->claims = $matter->claims;
                $this->parties = $matter->parties->each(function ($item) {
                    $item->type = $item->pivot->type;
                    $item->showAddSubPartyButton = $this->partyTypes[$item->name]['showAddPartyButton'];
                    $item->subParties = [];
                })->toArray();
            }
        }
        $this->expertsList = Expert::whereIn('category', ['main', 'certified'])->get(['id', 'name'])->toArray();
        $this->assistantsList = Expert::whereIn('category', ['main', 'certified', 'assistant'])->get(['id', 'name'])->toArray();
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

    public function save()
    {
        $this->validate();
        $data = [
            'matter' => $this->matter,
            'claims' => $this->claims,
            'parties' => $this->parties,
            'marketing' => $this->otherParties,
        ];

        /* dd($data); */
        $this->dispatchNow(new CreateMatter($data));

        return redirect(route('matter.show', session('last_inserted_matter')))->with('toast_success', __('app.matter-successfully-added'));
    }
}
