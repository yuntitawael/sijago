<?php

namespace App\Http\Livewire\Dashboard\DaftarDepot;

use App\Models\Depot;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Delete extends Component
{
    public $closeModal = false;

    // data request
    public $nama;
    public $dataHapus;

    public $idDelete;


    public function mount($depot)
    {
        $this->dataHapus = Depot::where('id_depot', $depot)->first();

        $this->nama = $this->dataHapus->nama;

        $this->idDelete = $depot;
    }

    public function destroy($id)
    {
        if ($this->dataHapus->image) {
            $images = explode('_', $this->dataHapus->image);
            foreach ($images as $data) {
                Storage::delete($data);
            }
        }

        DB::table('users')->where('id_owner', '=', $this->dataHapus->owner->id_owner)->delete();
        DB::table('owner')->where('id_owner', '=', $this->dataHapus->owner->id_owner)->delete();
        Depot::destroy('id_depot', $id);

        $this->emit('deleted');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.daftar-depot.delete');
    }
}
