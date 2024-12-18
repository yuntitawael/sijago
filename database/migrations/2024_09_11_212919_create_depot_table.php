<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depot', function (Blueprint $table) {
            $table->id('id_depot');
            $table->foreignId('id_owner');
            $table->foreignId('id_kelurahan')->nullable();
            $table->foreignId('id_kecamatan')->nullable();
            $table->string('nama')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('image')->nullable();
            $table->longText('keterangan')->nullable();
            $table->boolean('is_complete')->default(false);
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
        Schema::dropIfExists('depot');
    }
};
