<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class)->with('item');
    }
    
    public function totalPrice()
    {
        $totalPrice = 0;

        foreach ($this->transactionDetails as $detail) {
            $totalPrice += $detail->quantity * $detail->price_at;
        }

        return $totalPrice;
    }
}
