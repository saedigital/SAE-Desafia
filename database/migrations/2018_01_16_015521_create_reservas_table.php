<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status');
            $table->string('cpf');
            $table->decimal('preco');
            $table->integer('espetaculo')->unsigned()->nullable();
            $table->foreign('espetaculo')->references('id')->on('espetaculos');
            $table->integer('poltrona')->unsigned()->nullable();
            $table->foreign('poltrona')->references('id')->on('poltronas');
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
        Schema::dropIfExists('reservas');
    }
}
