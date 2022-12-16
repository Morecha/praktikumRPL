<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class katbarang extends Model
{
    use HasFactory;
    protected $table = 'katbarangs';
    protected static $ignoreChangedAttributes = ['update_at'];
    protected $fillable = [
        'id',
        'kategori',
        'created_at',
        'updated_at'
    ];
}
