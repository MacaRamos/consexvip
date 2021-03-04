<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('tipo_id')->constrained('tipos');
            $table->string('nombre', 100);
            $table->string('subtitulo', 100)->nullable();
            $table->string('descripcion', 5000);
            $table->string('ubicacion', 250);
            $table->bigInteger('telefono');
            $table->string('whatsapp', 250)->nullable();
            $table->integer('precio_hora')->nullable();
            $table->time('horario_inicio')->nullable();
            $table->time('horario_fin')->nullable();
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
        Schema::dropIfExists('anuncios');
    }
}
