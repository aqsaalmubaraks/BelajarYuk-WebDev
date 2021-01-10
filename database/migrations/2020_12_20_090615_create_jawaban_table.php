<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tugas')->unsigned();
            $table->foreign('id_tugas')->references('id')->on('tugas')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('id_siswa')->unsigned();
            $table->foreign('id_siswa')->references('id')->on('siswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->longText('jawaban');
            $table->integer('nilai')->nullable();
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
        Schema::dropIfExists('jawaban');
    }
}
