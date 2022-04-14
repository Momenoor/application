<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MatterChangeStatus extends Component
{

    public $matter;
    public $newStatus;

    protected $listeners = ['changeStatus'];

    public function mount($matter)
    {
        $this->matter = $matter;
    }

    public function render()
    {
        return view('livewire.matter-change-status');
    }

    public function changeStatusConfirm($newStatus)
    {
        $this->newStatus = $newStatus;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => __('app.are_you_sure_to_chnage_status') ,
            'text' => '',
            'id' => $this->matter->id,
            'callback' => 'changeStatus',
        ]);
    }

    public function changeStatus()
    {
        $matter = $this->matter;
        return redirect()->to(route('matter.change-status', ['matter' => $matter, 'status' => $this->newStatus]));
    }
}
