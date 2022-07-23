<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_inv',
        'jumlah_inv',
        'id_kategori',
        'id_lokasi'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori','id_kategori','id');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi','id_lokasi','id');
    }
}
