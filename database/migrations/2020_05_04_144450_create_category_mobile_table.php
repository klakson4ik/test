<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryMobileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_mobile', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('mobile_id')->unsigned();
            $table->foreign('mobile_id')->references('id')->on('mobiles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_mobile', function (Blueprint $table) {
            $table->dropForeign('category_mobile_category_id_foreign');
            $table->dropForeign('category_mobile_mobile_id_foreign');

        });
        Schema::dropIfExists('category_mobile');
    }
}
