<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->date('FechaNuevoPrestamo')->nullable();
            $table->double('Monto', 8, 2)->nullable();
            $table->double('Cuota', 8, 2)->nullable();
            $table->text('Frecuencia')->nullable();
            $table->longText('Filecedula')->nullable();
            $table->longText('FirmaNuevoPrestamo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
};
