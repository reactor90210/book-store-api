<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->default('image.png');
            $table->float('price', 8, 2);
            $table->unsignedTinyInteger('discount')->nullable();
            $table->boolean('in_stock')->default(1);
            $table->text('description');
            $table->text('information');
            $table->timestamps();
            $table->index('title');
            $table->index('in_stock');
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
