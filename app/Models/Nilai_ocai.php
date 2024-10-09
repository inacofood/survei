<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai_ocai extends Model
{
    public $table = 'nilai_ocai'; 
    protected $primaryKey = 'id_nilai';
    public $fillable = [
        'nama',
        'department',
        'id_kategori',
        'nilai_saat_ini',
        'nilai_ideal'
    ];

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department', 'id'); 
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_ocai::class, 'id_kategori', 'id_kategori');
    }

    
}
    

