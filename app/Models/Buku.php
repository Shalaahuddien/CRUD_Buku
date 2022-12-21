<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BukuController;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'deskripsi_buku',
        'tahun_terbit',
        'stok_buku',
        'gambar_buku'
    ];

}
