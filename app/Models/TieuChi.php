<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TieuChi extends Model
{
    protected $table = 'tieuchi';

    protected $fillable = [
        'ten_tieu_chi',
        'noi_dung',
        'loai_tieu_chi',
        'id_tieu_chuan',
    ];

}
