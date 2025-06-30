<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_id',
        'amount',
        'purchase_price',
    ];

    /**
     * Relasi ke user (siapa yang berinvestasi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke investment (produk investasinya)
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
