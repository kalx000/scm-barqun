<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        return $this->belongsTo(Customer::class);
    }
}
