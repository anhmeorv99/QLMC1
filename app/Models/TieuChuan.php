<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TieuChuan extends Model
{
    protected $table = 'tieuchuan';

    protected $fillable = [
        'ten_tieu_chuan',
        'noi_dung',
        'loai_tieu_chuan',
    ];

}
