<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // public function cardDetail()
    // {
    //     return $this->belongsTo(CardDetail::class,'card_id','id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'id','order_id');
    }

    protected $fillable = [
        'user_id', 'gallon', 'address', 'company', 'date', 'type_of_oil', 'status','transport_id'
    ];

    public function transport()
    {
        return $this->hasOne(Transport::class, 'id', 'transport_id');
    }
}
