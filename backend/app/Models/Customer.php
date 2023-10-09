<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function stockOut()
    {
        return $this->belongsTo(StockOut::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
