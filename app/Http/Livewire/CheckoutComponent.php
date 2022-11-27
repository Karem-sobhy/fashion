<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $discount;

    // User information
    public $name;
    public $phone;
    public $line1;
    public $line2;
    public $city;
    public $country;
    public $state;
    public $zip;

    public function cartValidate()
    {
        // Check cart count
        if (Cart::instance('cart')->count() == 0) {
            session()->flash('error_message', 'Your Cart is empty!');
            return redirect()->route('user.cart');
        }
        $discount = 0;
        // loop on all cart items
        foreach (Cart::instance('cart')->content() as $item) {
            Cart::instance('cart')->update($item->rowId, $item->model);

            // Check if instock
            if ($item->model->stock_status != 'instock') {
                session()->flash('error_message', 'The item ' . $item->model->name . ' is out of stock!');
                return redirect()->route('user.cart');
            }

            //check if have enough qty
            if ($item->qty > $item->model->quantity) {
                session()->flash('error_message', 'The item ' . $item->model->name . ' does not have this quantity left!');
                return redirect()->route('user.cart');
            }
            $discount += $item->model->discount() * $item->qty;
        }
        $this->discount = $discount;
        return true;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'phone' => 'required|numeric|digits_between:9,15',
            'line1' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);
    }

    public function placeOrder()
    {
        // Validate The Cart Items
        $this->cartValidate();
        // Validate The Information
        $this->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits_between:9,15',
            'line1' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        // Create order
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = Cart::instance('cart')->subTotal(2, '.', '');
        $order->discount = $this->discount;
        $order->tax = Cart::instance('cart')->tax(2, '.', '');
        $order->total = Cart::instance('cart')->total(2, '.', '');
        $order->name = $this->name;
        $order->phone = $this->phone;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->country = $this->country;
        $order->state = $this->state;
        $order->zip = $this->zip;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $product = Product::find($item->id);
            $product->quantity = $product->quantity - $item->qty;
            if ($product->quantity <= 0) {
                $product->stock_status = 'outofstock';
            }
            $product->save();
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }
        Cart::instance('cart')->destroy();
        session()->flash('success_message', 'Your Order Has been placed!');
        return redirect()->route('user.orders');
    }

    public function mount()
    {
        $this->cartValidate();
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        if ($user->has('profile')->exists()) {
            $this->phone = $user->profile->phone;
            $this->line1 = $user->profile->line1;
            $this->line2 = $user->profile->line2;
            $this->city = $user->profile->city;
            $this->country = $user->profile->country;
            $this->state = $user->profile->state;
            $this->zip = $user->profile->zip;
        }
    }




    public function render()
    {
        $user = User::find(Auth::user()->id);
        return view('livewire.checkout-component', ['user' => $user]);
    }
}