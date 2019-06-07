<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolitutoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solitutorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dia');
            $table->string('hora_inicio');
            $table->string('minutos_inicio');
            $table->string('hora_fin');
            $table->string('minutos_fin');
            $table->integer('materia_id');
            $table->integer('docente_id');
            $table->integer('estudiante_id');
            $table->text('motivo');
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
        Schema::dropIfExists('solitutorias');
    }
}
