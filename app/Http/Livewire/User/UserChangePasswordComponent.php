<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserChangePasswordComponent extends Component
{
    public $current_password;
    public $new_password;
    public $new_confirm_password;

    public function newpass()
    {
        $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password' => Hash::make($this->new_password)]);
        session()->flash('success_message', 'Password Updated!');
        return redirect()->route('user.profile');
    }


    public function render()
    {
        return view('livewire.user.user-change-password-component');
    }
}