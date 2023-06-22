<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxCutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_cuts', function (Blueprint $table) {
            $table->id();
            $table->float('sale')->default(0);
            $table->float('invoice')->default(0);
            $table->float('outlay')->default(0);
            $table->float('cash')->default(0);
            $table->float('total')->default(0);
            $table->foreignId('user_id')->nullable()->index();
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
        Schema::dropIfExists('box_cuts');
    }
}
