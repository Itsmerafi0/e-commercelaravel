<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'users_id','name','email','address','phone','courier',
        'payment','payment_url','total_price','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
