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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->string('author', 120);
            $table->string('genre', 100);
            $table->longText('description');
            $table->bigInteger('isbn');
            $table->string('image', 150);
            $table->date('published_on');
            $table->string('publisher', 150);
            $table->timestamps();
            $table->index(['title', 'author', 'published_on', 'isbn', 'genre']);
            $table->unique('isbn');
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
};
