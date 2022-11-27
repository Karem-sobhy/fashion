<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileComponent extends Component
{
    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.user.user-profile-component', ['user' => $user]);
    }
}