<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_income',
        'zakat_amount',
        'year',
        'status',
        'branch_data',
    ];
}
