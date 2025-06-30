<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositTransaction extends Model
{
    protected $fillable = ['user_id', 'method', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}