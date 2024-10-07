<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title_ocai extends Model
{
    public $table = 'title_ocai'; 
    protected $primaryKey = 'id_title';
    
    public $fillable = [
        'nama_title',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori_ocai::class, 'id_kategori');
    }
}
