<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $q;


    public function store($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        // dd($product);
        Cart::instance('cart')->add($product, 1);
        session()->flash('success_message', 'Item added in cart!');
        return redirect()->route('user.cart');
    }
    public function addwish($slug)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        Cart::instance('wish')->add($product, 1);
        // session()->flash('success_message', 'Item added in cart!');
        // return redirect()->route('user.cart');
    }
    public function removewish($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        foreach (Cart::instance('wish')->content() as $wishitem)
            if ($wishitem->id == $product->id) {
                Cart::instance('wish')->remove($wishitem->rowId);
                return;
            }
        // session()->flash('success_message', 'Item added in cart!');
        // return redirect()->route('user.cart');
    }



    public function mount($q = '')
    {
        $this->q = $q;
    }
    public function render()
    {
        // Cart Store Start
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wish')->store(Auth::user()->email);
        }
        // Cart Store End
        $products = Product::where('name', 'like', '%' . $this->q . '%')->active()->paginate(12);
        return view('livewire.search-component', ['products' => $products]);
    }
}