<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use Uuid;

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
