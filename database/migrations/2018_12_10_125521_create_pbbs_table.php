<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePbbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbbs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_bangunan', 60);
            $table->string('kelurahan', 255)->nullable();
            $table->string('luas_tanah', 10)->nullable();
            $table->string('luas_bangunan', 10)->nullable();
            $table->string('jumlah_bangunan', 3)->nullable();
            $table->string('address')->nullable();
            $table->string('ket')->nullable();
            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();
            $table->unsignedInteger('creator_id');
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pbbs');
    }
}
