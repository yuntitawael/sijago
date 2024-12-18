<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.index', [
            'title' => env('APP_NAME') . ' ' . env('DISTRICT_NAME') . ' | Dashboard',
            'title_page' => 'Dashboard',

        ])->extends('dashboard-layouts.app')->section('container');
    }
}
