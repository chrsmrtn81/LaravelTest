<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('source_name');
            $table->foreignId('source_id')->constrained('sources');
            $table->string('title');
            $table->string('short_description', 600)->nullable();
            $table->text('description', 2000)->nullable();
            $table->string('link');
            $table->datetime('pub_date');
            $table->string('categories');
            $table->string('image', 300)->nullable();
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
