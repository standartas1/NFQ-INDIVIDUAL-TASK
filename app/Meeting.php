<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';
    protected $fillable = [
        'first-name', 
        'last-name', 
        'meeting-time'
    ];
}
