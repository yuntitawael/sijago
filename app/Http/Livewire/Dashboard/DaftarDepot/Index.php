<?php

namespace App\Http\Livewire\Dashboard\DaftarDepot;

use App\Models\Depot;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireUpdate = false;
    public $showLivewireDelete = false;

    public $getDepot;

    public $paginate = 20;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
        'updated' => 'handleUpdated',
        'deleted' => 'handleDeleted',

        'closeLivewire' => 'handleCloseLivewire',
    ];

    // create
    public function create()
    {
        $this->showLivewireCreate = true;
    }
    public function handleStored()
    {
        $this->showLivewireCreate = false;
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

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $depot = Depot::where('id_depot', $id)->first();
        $this->getDepot = $depot->id_depot;
    }
    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireUpdate = false;
        $this->showLivewireDelete = false;
    }

    public function render()
    {
        return view('livewire.dashboard.daftar-depot.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME')   . ' | Dashboard - Daftar Depot Air',
            'title_page' => 'Daftar Depot Air',
            'depot' => $this->search == null ?
                Depot::where('is_complete', true)->orderBy('nama', 'ASC')->paginate($this->paginate) :
                Depot::where('is_complete', true)->where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('nama', 'ASC')->paginate($this->paginate)
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
