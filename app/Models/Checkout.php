<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'camp_id',
        'card_number',
        'expired',
        'cvc',
        'is_paid',
    ];

    public function expired(): Attribute
    {
        return Attribute::make(
            set: fn($value) => date('Y-m-t', strtotime($value))
        );
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }
}
