<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCaracteristicaToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solitutorias', function (Blueprint $table) {
            $table->string('modalidad',10)->after('estudiante_id');
            $table->string('tipo',10)->after('modalidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table', function (Blueprint $table) {
            $table->dropColumn('modalidad');
            $table->dropColumn('tipo');
        });
    }
}
