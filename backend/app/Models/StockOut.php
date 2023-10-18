<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
