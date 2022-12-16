<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembukuan extends Model
{
    use HasFactory;
    protected $table = 'pembukuans';
    protected static $ignoreChangedAttributes = ['update_at'];
    protected $fillable = [
        'id',
        'id_barang',
        'id_staff',
        'status',
        'jumlah',
        'bulan',
        'created_at',
        'updated_at'
    ];
}
