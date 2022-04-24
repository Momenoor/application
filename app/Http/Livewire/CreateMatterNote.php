<?php

namespace App\Http\Livewire;

use App\Models\Matter;
use App\Models\Note;
use Livewire\Component;

class CreateMatterNote extends Component
{

    public $notes = [];
    public $matter;

    public $note;

    protected $rules = [
        'note' => 'required',
    ];

    protected $listeners = ['delete'];

    public function mount(Matter $matter)
    {
        $this->matter = $matter;
        $this->notes = Note::where('matter_id', $this->matter->id)->get();
    }

    public function render()
    {
        $this->mount($this->matter);
        return view('pages.matters.form.partials._show_notes');
    }

    public function send()
    {
        $this->validate();
        $this->matter->notes()->create([
            'text' => $this->note,
        ]);
        $this->note = '';
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => __('app.are_you_sure_to_delete'),
            'text' => '',
            'id' => $id,
            'callback' => 'delete',
        ]);
    }

    public function delete($id)
    {
        Note::where('id', $id)->delete();
    }
}
