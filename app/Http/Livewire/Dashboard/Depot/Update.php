<?php

namespace App\Http\Livewire\Dashboard\Depot;

use App\Models\Depot;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $closeModal = false;

    // data request
    public $nama;
    public $kelurahan;
    public $kecamatan;
    public $koordinat;
    public $image = [];
    public $image_old;
    public $keterangan;

    public $error_image = false;

    public $dataEdit;

    public $get_kelurahan;

    public $idEdit;

    public $depot;

    public function remove_item($index)
    {
        array_splice($this->image, $index);
    }

    public function mount($depot, $my_koordinat)
    {
        $this->nama = $depot['nama'];
        $this->kelurahan = $depot['id_kelurahan'];
        $this->kecamatan = $depot['id_kecamatan'];
        $this->image_old = $depot['image'];
        $this->keterangan = $depot['keterangan'];

        if ($depot['koordinat'] == null) {
            $this->koordinat = $my_koordinat;
        } else {
            $this->koordinat = $depot['koordinat'];
        }

        $this->idEdit = $depot['id_depot'];

        $this->depot = $depot;

        if ($this->kecamatan) {
            $this->get_kelurahan = Village::where('district_id', $this->kecamatan)->orderBy('name')->get();
        }
    }

    public function update($id)
    {
        $rules = [
            // 'nama' => 'required|max:255|unique:depot,nama',
            'kecamatan' => 'required|max:255',
            'kelurahan' => 'required|max:255',
            'koordinat' => 'required|max:255',
            'keterangan' => 'required',
        ];

        if ($this->depot->nama) {
            if ($this->nama != $this->depot->nama) {
                $rules['nama'] = 'required|max:255|unique:depot,nama';
            }
        } else {
            $rules['nama'] = 'required|max:255|unique:depot,nama';
        }

        if ($this->image_old == null && count($this->image) > 0) {
            $rules['image.*'] = 'required|image|max:10024';
        }

        if ($this->image_old && count($this->image) > 0) {
            $rules['image.*'] = 'required|image|max:10024';
        }

        $this->validate($rules);

        if ($this->image_old == null && count($this->image) <= 0) {
            session()->flash('image_required');
            return false;
        }

        if ($this->image) {
            if ($this->image_old) {
                $get_data_image = explode('_', $this->image_old);
                foreach ($get_data_image as $data) {
                    Storage::delete($data);
                }
            }
            $fileName = '';
            foreach ($this->image as $data) {
                $fileName .= $data->store('depot') . '_';
            }
        } else {
            $fileName = $this->image_old;
        }

        Depot::where('id_depot', $id)->update([
            'nama' => $this->nama,
            'id_kecamatan' => $this->kecamatan,
            'id_kelurahan' => $this->kelurahan,
            'koordinat' => $this->koordinat,
            'image' => $fileName,
            'keterangan' => $this->keterangan,
            'is_complete' => true
        ]);

        $this->cleanLiveWireTemp();

        $this->emit('updated');

        $this->closeModal = true;

        session()->flash('message');
    }

    protected function cleanLiveWireTemp()
    {
        $storage = Storage::disk('public');

        foreach ($storage->allFiles('livewire-tmp') as $filePath) {
            $storage->delete($filePath);
        }
    }

    public function opsi_kelurahan()
    {
        $this->get_kelurahan = Village::where('district_id', $this->kecamatan)->orderBy('name')->get();
        // dd($this->get_kelurahan->count());
    }

    public function render()
    {
        return view('livewire.dashboard.depot.update', [
            'get_kecamatan' => District::where('regency_id', 8171)->get()
        ]);
    }
}
