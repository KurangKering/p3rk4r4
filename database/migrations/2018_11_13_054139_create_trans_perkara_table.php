<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransPerkaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_perkara', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_perkara')->nullable();
            $table->string('tergugat')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->unsignedInteger('penggugat_user_id')->nullable();
            $table->unsignedInteger('mst_perkara_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('trans_perkara');
    }
}
