<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul_buku',
        'penulis',
        'kategori',
        'tahun_terbit',
        'jumlah_stock',
        'status',
        'deskripsi',
        'loan_status',
    ];


    public function pinjambukus()
    {
        return $this->hasMany(pinjambuku::class);
    }
    
}