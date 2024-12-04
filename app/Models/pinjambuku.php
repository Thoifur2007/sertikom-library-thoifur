<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pinjambuku extends Model
{
    protected $fillable = [
        'user_id', 
        'book_id', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'tanggal_dikembalikan', 
        'status'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


