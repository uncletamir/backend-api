<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kategori', 'nama_barang', 'jumlah_barang', 'jenis_barang'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori','kode_kategori','id');
    }
}
