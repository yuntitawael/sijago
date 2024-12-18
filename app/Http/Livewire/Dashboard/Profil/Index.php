<?php

namespace App\Http\Livewire\Dashboard\Profil;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $showUpdateNama = false;
    public $showUpdateUsername = false;
    public $showUpdatePassword = false;
    public $showUpdateEmail = false;

    public $getUser;
    public $image;

    protected $listeners = [
        'namaUpdated' => 'handleNamaUpdated',
        'usernameUpdated' => 'handleUsernameUpdated',
        'passwordUpdated' => 'handlePasswordUpdated',

        'closeLivewire' => 'handleCloseLivewire',

        'success'
    ];

    // update nama
    public function updateNama()
    {
        $this->showUpdateNama = true;
    }

    public function handleNamaUpdated()
    {
        $this->showUpdateNama = false;
    }

    // update username
    public function updateUsername()
    {
        $this->showUpdateUsername = true;
    }

    public function handleUsernameUpdated()
    {
        $this->showUpdateUsername = false;
    }

    // update password
    public function updatePassword()
    {
        $this->showUpdatePassword = true;
    }

    public function handlePasswordUpdated()
    {
        $this->showUpdatePassword = false;
    }

    public function handleCloseLivewire()
    {
        $this->showUpdateNama = false;
        $this->showUpdateUsername = false;
        $this->showUpdateEmail = false;
        $this->showUpdatePassword = false;
    }


    public function success()
    {
    }

    public function render()
    {
        return view('livewire.dashboard.profil.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME') . ' | Profil Saya',
            'title_page' => 'Profil Saya',

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
