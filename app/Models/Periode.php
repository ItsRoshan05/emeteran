<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = [
        'kode_periode',
        'awal',
        'akhir',
        'status',
    ];

    // Relasi: Periode memiliki banyak meteran
    public function meterans()
    {
        return $this->hasMany(Meteran::class);
    }

    // Ambil periode yang sedang aktif
    public static function getAktif()
    {
        return self::where('status', 'AKTIF')->first();
    }
}
