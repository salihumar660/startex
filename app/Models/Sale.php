<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class,'sale_id','id');
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'branch_id','branch_id');
    }
}
