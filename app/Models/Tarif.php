<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarifs'; // Nama tabel jika berbeda dari konvensi Laravel
    protected $fillable = [
        'harga_per_m3',
        'keterangan',
    ];

    // Relasi jika nantinya ingin dipakai di tagihan atau pemakaian
    public function pemakaians()
    {
        return $this->hasMany(Pemakaian::class); // jika nanti pemakaian mengacu ke tarif
    }
}
