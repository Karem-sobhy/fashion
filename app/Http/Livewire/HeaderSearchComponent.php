<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderSearchComponent extends Component
{
    public $search;
    public function search()
    {

        return redirect()->route('home.search', ['q' => $this->search]);
    }
    public function render()
    {

        return view('livewire.header-search-component');
    }
}