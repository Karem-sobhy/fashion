<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminProductsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $itemsPerPage = 5;
    public $delProductName;
    public $delProductId;

    public function feature($bool, Product $product)
    {
        $product->featured = $bool;
        $product->save();
    }
    public function stock($stock_status, Product $product)
    {
        $product->stock_status = $stock_status;
        $product->save();
    }

    public function deleteId(Product $product)
    {
        $this->delProductId = $product->id;
        $this->delProductName = $product->name;
    }
    public function delete()
    {
        $product = Product::find($this->delProductId);
        $product->delete();
    }

    public function render()
    {
        if ($this->itemsPerPage != 'all') {
            $products = Product::paginate($this->itemsPerPage);
        } else {
            $products = Product::all();
        }
        return view('livewire.admin.admin-products-component', ['products' => $products])->extends('adminlte::page')->section('content');
    }
}