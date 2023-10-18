<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    function stockIn()
    {
        return $this->belongsTo(StockIn::class);
    }
}
