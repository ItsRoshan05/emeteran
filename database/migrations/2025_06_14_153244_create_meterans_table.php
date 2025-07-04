<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeteransTable extends Migration
{
    public function up(): void
    {
        Schema::create('meterans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained('periodes')->onDelete('cascade');
            $table->float('jumlah_meteran');
            $table->float('tarif'); // Snapshot dari tarifs saat input
            $table->float('total_tagihan');
            $table->enum('status_bayar', ['LUNAS', 'BELUM'])->default('BELUM');
            $table->enum('metode_bayar', ['CASH'])->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->foreignId('petugas_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meterans');
    }
}
