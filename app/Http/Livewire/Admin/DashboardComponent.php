<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DashboardComponent extends Component
{

    public function render()
    {
        return view('livewire.admin.dashboard-component')->extends('adminlte::page');
    }
}