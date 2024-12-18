<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $showLivewireCreate = false;
    public $showLivewireDelete = false;

    public $getAdmin;

    public $paginate = 20;
    public $search;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'stored' => 'handleStored',
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

    // delete
    public function delete($id)
    {
        $this->showLivewireDelete = true;

        $admin = User::where('id', $id)->first();
        $this->getAdmin = $admin->id;
    }
    public function handleDeleted()
    {
        $this->showLivewireDelete = false;
    }

    public function handleCloseLivewire()
    {
        $this->showLivewireCreate = false;
        $this->showLivewireDelete = false;
    }

    public function render()
    {
        return view('livewire.dashboard.user.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME')   . ' | Dashboard - Admin',
            'title_page' => 'Admin',
            'admin' => User::where('level', 0)->orderBy('nama', 'ASC')->get()
        ])->extends('dashboard-layouts.app')->section('container');
    }
}
