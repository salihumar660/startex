<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mailer\Transport\Transports;

class DriverDetail extends Model
{
    use HasFactory;

    // public function transport()
    // {
    //     return $this->hasOne(Transport::class, 'id', 'transport_id');
    // }

}
