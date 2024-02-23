<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'total_item',
        'total_harga',
        'status_pembayaran',
        'created_at',
        'updated_at'
    ];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id_barang', 'id_barang');
    }
}