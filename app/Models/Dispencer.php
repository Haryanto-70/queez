<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispencer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company',
        'service_list',
        'name',
        'detail',
        'order_list',
    ];
}
