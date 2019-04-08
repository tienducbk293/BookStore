<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->unsignedInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->integer('saleoff_price');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('status')->default(0);
            $table->string('slug', 100);
            $table->text('summary');
            $table->string('thumnail', 100);
            $table->double('rate', 1,1);
            $table->integer('release_date');
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
        Schema::dropIfExists('books');
    }
}
