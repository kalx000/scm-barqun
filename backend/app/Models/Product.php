<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Uuid;

    protected $guarded = ['id'];

    public function stockIn()
    {
        return $this->belongsTo(StockIn::class);
    }

    public function stockOut()
    {
        return $this->belongsTo(StockOut::class);
    }

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class);
    }
}
