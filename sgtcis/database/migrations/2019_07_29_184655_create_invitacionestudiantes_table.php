<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitacionestudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitacionestudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_invita_id');
            $table->string('user_invitado_id',70);
            $table->integer('solitutoria_id')->nullable();
            $table->string('confirmacion',200);
            $table->string('fecha_invita',2500);
            $table->string('notificacion_id')->nullable();
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
        Schema::dropIfExists('invitacionestudiantes');
    }
}
