<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'dc',
        'ci',
        'co',
        'activity',
        'remark',
        'from',
        'to',
        'std',
        'sta',
        'ac',
        'blh',
    ];
}
