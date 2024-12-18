<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $closeModal = false;

    // data request
    public $nama;
    public $username;
    public $password;

    public function store()
    {
        $this->validate([
            'nama' => 'required|max:25',
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|min:8',
        ]);

        User::create([
            'nama' => $this->nama,
            'username' => $this->username,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'level' => false
        ]);

        $this->emit('stored');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.dashboard.user.create');
    }
}
