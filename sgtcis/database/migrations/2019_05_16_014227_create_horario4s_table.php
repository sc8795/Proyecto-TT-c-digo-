<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorario4sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario4s', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            /* MAÑANA JUEVES */
            $table->string('dia4_op1')->default("NA");
            $table->string('hora_inicio_op1')->default("NA");
            $table->string('minutos_inicio_op1')->default("NA");
            $table->string('hora_fin_op1')->default("NA");
            $table->string('minutos_fin_op1')->default("NA");

            $table->string('dia4_op2')->default("NA");
            $table->string('hora_inicio_op2')->default("NA");
            $table->string('minutos_inicio_op2')->default("NA");
            $table->string('hora_fin_op2')->default("NA");
            $table->string('minutos_fin_op2')->default("NA");

            /* TARDE JUEVES*/
            $table->string('dia4_op3')->default("NA");
            $table->string('hora_inicio_op3')->default("NA");
            $table->string('minutos_inicio_op3')->default("NA");
            $table->string('hora_fin_op3')->default("NA");
            $table->string('minutos_fin_op3')->default("NA");

            $table->integer('cont_dia');
            $table->integer('cont_tarde');

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
        Schema::dropIfExists('horario4s');
    }
}
