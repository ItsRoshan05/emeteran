<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->string('kode_periode')->unique(); // Contoh: 202506
            $table->date('awal');   // Tanggal mulai periode
            $table->date('akhir');  // Tanggal akhir periode
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('NONAKTIF');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
}
