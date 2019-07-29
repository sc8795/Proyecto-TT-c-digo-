<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_invita_id');
            $table->string('user_invitado_id',500);
            $table->integer('solitutoria_id')->nullable();
            $table->string('title');
            $table->text('descripcion');
            $table->string('fecha_invita',500);
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
        Schema::dropIfExists('invitacions');
    }
}
