<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEditProfileComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $phone;
    public $image;
    public $line1;
    public $line2;
    public $city;
    public $country;
    public $state;
    public $zip;
    public $newimage;
    public $uploaded;

    public function mount()
    {

        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->image = $user->profile->image;
        $this->phone = $user->profile->phone;
        $this->line1 = $user->profile->line1;
        $this->line2 = $user->profile->line2;
        $this->city = $user->profile->city;
        $this->country = $user->profile->country;
        $this->state = $user->profile->state;
        $this->zip = $user->profile->zip;
    }

    public function updatedUploaded()
    {
        $this->validate([
            'uploaded' => 'image|max:1024', // 1MB Max
        ]);
        $this->newimage = $this->uploaded;
    }

    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->save();

        if ($this->newimage) {
            if ($this->image) {
                unlink('assets/img/profile/' . $this->image);
            }
            $imagename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('profile', $imagename);
            $user->profile->image = $imagename;
            $this->image = $imagename;
            $this->newimage = null;
        }
        $user->profile->phone = $this->phone;
        $user->profile->line1 = $this->line1;
        $user->profile->line2 = $this->line2;
        $user->profile->city = $this->city;
        $user->profile->country = $this->country;
        $user->profile->state = $this->state;
        $user->profile->zip =  $this->zip;
        $user->profile->save();
        session()->flash('success_message', 'Profile have been Updated');
        return redirect()->route('user.profile');
    }

    public function render()
    {
        return view('livewire.user.user-edit-profile-component');
    }
}