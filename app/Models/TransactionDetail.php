<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $table = "transaction_details";
    protected $guarded = ['id'];
    protected $fillable = ['transaction_id','item_id','quantity','price_at'];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
