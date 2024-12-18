<?php

namespace App\Http\Livewire;

use App\Models\Owner;
use App\Models\User;
use Livewire\Component;

class Registrasi extends Component
{
    public $closeModal = false;

    // data request

    public $nama;
    public $nomor_whatsapp;
    public $jenis_kelamin;
    public $username;
    public $password;


    public function store()
    {
        $this->validate([
            'nama' => 'required|max:255',
            'nomor_whatsapp' => 'required|unique:owner,nomor_whatsapp',
            'jenis_kelamin' => 'required|max:255',
            // 'username' => 'required|digits:16|unique:users,username',
            'password' => 'required|min:6',
        ]);

        $no_wa = substr($this->nomor_whatsapp, 0,2);

        if($no_wa != '62'){
            session()->flash('no_whatsapp_invalid');
            return false;
        }

        if(strlen($this->password) < 8){
            session()->flash('batas_password');
            return false;
        }


        Owner::create([
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nomor_whatsapp' => $this->nomor_whatsapp,
        ]);

        $owner = Owner::where('nomor_whatsapp', $this->nomor_whatsapp)->first();

        User::create([
            'id_owner' => $owner->id_owner,
            'nama' => $this->nama,
            'username' => $this->nomor_whatsapp,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
        ]);

        $this->emit('register');

        $this->closeModal = true;

        session()->flash('message');
    }

    public function render()
    {
        return view('livewire.registrasi');
    }
}
