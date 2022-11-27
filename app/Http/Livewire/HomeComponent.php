<?php

namespace App\Http\Livewire;

use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function mount()
    {
        if (Auth::check()) {
            Cart::instance('cart')->restore(Auth::user()->email);
            Cart::instance('wish')->restore(Auth::user()->email);
            User::find(Auth::user()->id)->profile()->firstOrCreate();
            // Auth::user()->profile()->firstOrCreate();
        }
    }
    public function render()
    {
        return view('livewire.home-component');
    }
}