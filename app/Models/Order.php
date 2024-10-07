<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = ['id'];

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function buyer():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getOrderDateAttribute($value)
    {
        Carbon::setLocale('id');
        return Carbon::createFromTimestamp($value)->format('l, d F Y');
    }
}
