<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'badge',
        'category_id',
        'image',
        'market_price',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'investment_user', 'investment_id', 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(InvestmentTransaction::class);
    }

}