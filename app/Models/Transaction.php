<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_email',
        'username_roblox',
        'total_amount',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}
