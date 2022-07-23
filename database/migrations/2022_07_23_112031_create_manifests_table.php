<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('nama_event');
            $table->string('nama_penanggung_jawab');
            $table->string('lokasi_event');
            $table->enum('status', ['keluar', 'masuk'])->default('keluar');
            $table->longText('list_barang');
            $table->text('note');
            $table->date('tanggal_event');
            $table->date('tanggal_barang_keluar');
            $table->date('tanggal_barang_masuk');
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
        Schema::dropIfExists('manifests');
    }
}
