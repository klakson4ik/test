<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryLargeTechnicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_large_technical', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('large_technical_id')->unsigned();
            $table->foreign('large_technical_id')->references('id')->on('large_technicals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_large_technical', function (Blueprint $table) {
            $table->dropForeign('category_large_technical_category_id_foreign');
            $table->dropForeign('category_large_technical_large_technical_id_foreign');

        });
        Schema::dropIfExists('category_large_technical');
    }
}
