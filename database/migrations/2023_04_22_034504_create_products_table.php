<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_product');
            $table->float('price');
            $table->float('cost');
            $table->foreignId('category_id')
            ->references('id')
            ->on('categories');
            $table->text('description')->nullable();
            $table->string('barcode')->unique()->index()->nullable();
            $table->string('code')->unique()->index();
            $table->string('sku')->unique()->index()->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('minimum_qty')->default(0);
            $table->integer('discount')->default(0);
            $table->enum('unit', ['Unidad', 'Fraccion'])->default('Unidad');
            $table->boolean('favorite')->default(0);

            $table->string('url_image')->nullable();
            $table->boolean('notification_minimum_qty')->default(0);
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
        Schema::dropIfExists('products');
    }
}
