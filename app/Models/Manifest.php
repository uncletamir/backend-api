<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_event',
        'nama_penanggung_jawab',
        'lokasi_event',
        'tanggal_event',
        'tanggal_barang_keluar',
        'tanggal_barang_masuk',
        'status',
        'list_barang',
        'note',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }
}
