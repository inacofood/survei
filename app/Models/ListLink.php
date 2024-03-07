<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListLink extends Model
{
    public $table = 'lists'; // Sesuaikan dengan nama tabel Anda

    protected $primaryKey = 'id'; // Jika primary key tabel Anda bukan 'id', sesuaikan dengan nama primary key yang digunakan

    public $fillable = [
        'category',
        'sub_cat',
        'title',
        'link',
        'video',
        'status',
        'created_at',
        'updated_at',
        // Tambahkan nama kolom lainnya yang ingin Anda isikan secara massal
    ];
}
