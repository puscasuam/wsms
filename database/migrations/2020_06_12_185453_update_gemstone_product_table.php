<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGemstoneProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();

        Schema::table('gemstone_product', function (Blueprint $table) {

            $table->dropForeign(['product_id']);
            $table->dropForeign(['gemstone_id']);

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('CASCADE');
            $table->foreign('gemstone_id')->references('id')->on('gemstones')
                ->onDelete('cascade')
                ->onUpdate('CASCADE');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
