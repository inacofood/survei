<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_ocai extends Model
{
    public $table = 'kategori_ocai'; 
    protected $primaryKey = 'id_kategori';
    public $fillable = [
        'nama_kategori',
    ];
}
