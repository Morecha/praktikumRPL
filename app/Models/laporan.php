<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';
    protected static $ignoreChangedAttributes = ['update_at'];
    protected $fillable = [
        'id',
        'bulan',
        'tahun',
        'data',
        'updated_at',
        'created_at'
    ];
}
