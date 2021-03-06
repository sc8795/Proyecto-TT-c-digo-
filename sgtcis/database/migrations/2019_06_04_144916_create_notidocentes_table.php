<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotidocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notidocentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('user_docente_id');
            $table->integer('solitutoria_id');
            $table->string('title');
            $table->text('descripcion');
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
        Schema::dropIfExists('notidocentes');
    }
}
