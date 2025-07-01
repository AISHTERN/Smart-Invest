<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'method_type',
        'bank_name',
        'ewallet_name',
        'account_number',
        'account_name',
        'status',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}