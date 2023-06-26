<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_setups', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('RFC')->default('00000000');
            $table->string('phone')->default('00000000');
            $table->string('address')->default('Calle 23, No177 Colonia Jardines de Sta. Clara');
            $table->string('email')->default('correo@ejemplo.com');
            $table->string('text_footer')->default('*** Precios de productos incluyen
            impuestos. Para poder realizar un
            reclamo o devolución debe de presentar
            este ticket ***');
            $table->string('text_thanks')->default('Gracias por su compra');

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
        Schema::dropIfExists('ticket_setups');
    }
}
