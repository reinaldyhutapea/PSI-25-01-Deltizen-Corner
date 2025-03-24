<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirm()
    {
        return $this->hasOne(Confirm::class);
    }

    public function products() // Perbaikan relasi Many-to-Many
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }
}
