<?php

namespace App\Http\Livewire;

use App\Models\Depot;
use Livewire\Component;

class ShowDepot extends Component
{
    public $depot;
    public $lati;
    public $long;
    public $koordinat;
    public $jarak;

    public $showLivewirePesanan = false;

    protected $listeners = [
        'getLatLangForInput',
    ];

    public function mount(Depot $depot)
    {
        $this->depot = $depot;
    }

    public function depot_opsi($id)
    {
        $depot = Depot::where('id_depot', $id)->first();
        return redirect('/depot/' . $depot->id_depot . '/show');
    }

    public function getLatLangForInput($lat, $long)
    {
        $this->koordinat = explode(',', $this->depot->koordinat);
        $this->jarak = $this->getJarakKoordinat($lat, $long, $this->koordinat[0], $this->koordinat[1]);
        // dd($this->jarak);
    }

    public function getJarakKoordinat($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return number_format($meters, 2, '.','');
    }

    public function render()
    {
        return view('livewire.show-depot', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME') . ' | ' . $this->depot->nama,
            'subtitle' => '<li><a href="/">Beranda</a></li><li>' . $this->depot->nama . '</li>',
            'title_page' => $this->depot->nama,
        ])->extends('layouts.app')->section('container');
    }
}
