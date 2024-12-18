<?php

namespace App\Http\Livewire;

use App\Models\Depot;
use App\Models\District;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search;
    public $koordinat_lat;
    public $koordinat_long;

    public $kecamatan;
    public $kelurahan;
    public $get_kelurahan;

    protected $listeners = [
        'getLatLangForInput',
    ];

    public function getLatLangForInput($lat, $long)
    {
        $this->koordinat_lat = $lat;
        $this->koordinat_long = $long;
    }

    public function depot_opsi($id)
    {
        $depot = Depot::where('id_depot', $id)->first();
        return redirect('/depot/' . $depot->id_depot . '/show');
    }

    public function opsi_kelurahan()
    {
        if ($this->kecamatan == '') {
            $this->kelurahan = '';
        }
        $this->get_kelurahan = Village::where('district_id', $this->kecamatan)->orderBy('name')->get();
        // dd($this->get_kelurahan->count());
    }

    public function render()
    {
        // $get_depot = Depot::where('is_complete', true)->orderBy('nama', 'ASC')->paginate($this->paginate);

        if ($this->kecamatan && $this->kelurahan == null) {
            $get_depot = Depot::where('is_complete', true)
                ->where('id_kecamatan', $this->kecamatan)
                ->orderBy('nama', 'ASC')->paginate($this->paginate);
        } else  if ($this->kecamatan && $this->kelurahan) {
            $get_depot = Depot::where('is_complete', true)
                ->where('id_kecamatan', $this->kecamatan)
                ->where('id_kelurahan', $this->kelurahan)
                ->orderBy('nama', 'ASC')->paginate($this->paginate);
        } else {
            $get_depot = Depot::where('is_complete', true)->orderBy('nama', 'ASC')->paginate($this->paginate);
        }


        return view('livewire.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME'),
            'get_kecamatan' => District::where('regency_id', 8171)->get(),
            'depot' => $get_depot
        ])->layout('index');
    }
}
