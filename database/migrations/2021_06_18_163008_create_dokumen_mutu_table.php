<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenMutuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_mutu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis_dokumen', ['buku mutu', 'manual', 'standard', 'formulir', 'instruksi kerja']);
            $table->string('nama', 60);
            $table->text('keterangan');
            $table->enum('kategori', ['kategori 1', 'kategori 2', 'kategori 3'])->nullable();
            $table->string('kode', 30)->nullable();
            $table->string('nama_file', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_mutu');
    }
}
