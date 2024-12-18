<?php

namespace App\Http\Livewire\Dashboard\Depot;

use App\Models\Depot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireUpdate = false;

    public $getDepot;

    public $myKoordinat;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'updated' => 'handleUpdated',

        'closeLivewire' => 'handleCloseLivewire',

        'getMyKordinat'
    ];

    public function getMyKordinat($lat, $long)
    {
        $this->myKoordinat = $lat.', '.$long;
    }


    public function create()
    {
        Depot::create([
            'id_owner' => Auth()->user()->id_owner
        ]);
    }


    // edit
    public function edit($id)
    {
        $this->showLivewireUpdate = true;

        $depot = Depot::where('id_depot', $id)->first();
        $this->getDepot = $depot;
    }
    public function handleUpdated()
    {
        $this->showLivewireUpdate = false;
    }


    public function handleCloseLivewire()
    {
        $this->showLivewireUpdate = false;
    }

    public function render()
    {
        return view('livewire.dashboard.depot.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME')   . ' | Dashboard - Depot Saya',
            'title_page' => 'Depot Saya',
            'depot' => Depot::where('id_owner', Auth()->user()->id_owner)->first()
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
