<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('prod_id');
            $table->string('prod_name');
            $table->text('prod_description');
            $table->float('prod_price');
            $table->integer('prod_score', false, true);
            $table->integer('prod_in_stock', false, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
