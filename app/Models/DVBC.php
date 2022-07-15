<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DVBC extends Model
{
    protected $table = 'dvbc';

    protected $fillable = [
        'ten_dvbc', 'phone', 'address', 
    ];

}
