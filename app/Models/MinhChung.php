<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinhChung extends Model
{
    protected $table = 'minhchung';
    protected $fillable = [
        'ten_minh_chung',
        'noi_dung',
        'id_dvbc',
        'id_ctdt',
        'id_tieu_chi',
        'file',
        'hash_file',
        'duyet'
    ];
}
