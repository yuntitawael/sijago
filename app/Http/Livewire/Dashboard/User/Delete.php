<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $idDelete;
    public $nama;

    public $dataHapus;


    public function mount($admin)
    {
        $this->dataHapus = User::where('id', $admin)->first();
        $this->nama = $this->dataHapus->nama;

        $this->idDelete = $admin;
    }

    public function destroy($id)
    {
        User::destroy('id', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.user.delete');
    }
}
