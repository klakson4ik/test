<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTelevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_television', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('television_id')->unsigned();
            $table->foreign('television_id')->references('id')->on('televisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_television', function (Blueprint $table) {
            $table->dropForeign('category_television_category_id_foreign');
            $table->dropForeign('category_television_television_id_foreign');

        });
        Schema::dropIfExists('category_television');
    }
}
