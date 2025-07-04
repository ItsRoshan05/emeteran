<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meteran extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'periode_id',
        'jumlah_meteran',
        'tarif',
        'total_tagihan',
        'status_bayar',
        'metode_bayar',
        'tanggal_bayar',
        'petugas_id',
    ];

public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'pelanggan_id'); // ✅ BENAR
}


    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
