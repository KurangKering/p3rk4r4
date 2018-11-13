<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransPerkaraDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_perkara_det', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tanggal_bayar')->nullable();
            $table->decimal('jumlah_bayar', 12, 0)->nullable();
            $table->unsignedInteger('trans_perkara_id')->nullable();
            $table->string('uraian')->nullable();
            $table->unsignedInteger('mst_jenis_transaksi_id')->nullable();
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
        Schema::dropIfExists('trans_perkara_det');
    }
}
