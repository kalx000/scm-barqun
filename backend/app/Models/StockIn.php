<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
