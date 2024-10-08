<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = ['id'];

    public function seller():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    

}
