<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Buyable
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = '';
    protected $with = ['orderItem','category'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('stock_status', 'instock');
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        if ((!is_null($this->sale_price) && $this->price > $this->sale_price)) {
            return $this->sale_price;
        }
        return $this->price;
    }
    public function onSale()
    {
        if ((!is_null($this->sale_price) && $this->price > $this->sale_price)) {
            if ((!is_null($this->sale_price) && $this->price > $this->sale_price)) {
                return true;
            }
            return false;
        }
    }
    public function sale()
    {
        return number_format(($this->price - $this->sale_price) / $this->price * 100, 2);
    }

    public function discount()
    {
        if (!$this->onSale()) {
            return 0;
        } else {
            return $this->price - $this->getBuyablePrice();
        }
    }
    public function rating()
    {
        $rating = round($this->orderItem->where('product_id', $this->id)->whereNotNull('review')->avg('review'));
        return $rating;
    }
}
