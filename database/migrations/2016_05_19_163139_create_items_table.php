<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index();
            $table->integer('subcat_id')->index();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 6, 2);
            $table->integer('sifra')->nullable();
            $table->boolean('akcija')->nullable();
            $table->boolean('popularno')->nullable();
            $table->string('img');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('items');
    }
}
