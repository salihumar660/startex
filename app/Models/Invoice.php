<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function dtn() {
        return $this->belongsTo(Dtn::class, 'dtn_id');
    }

    public function customer() {
        return $this->belongsTo(CustomerDetail::class, 'customer_id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
}
