<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b099bf7d0cfbContentCategoryContentPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('content_category_content_page')) {
            Schema::create('content_category_content_page', function (Blueprint $table) {
                $table->integer('content_category_id')->unsigned()->nullable();
                $table->foreign('content_category_id', 'fk_p_164424_164426_conten_5b099bf7d0e24')->references('id')->on('content_categories')->onDelete('cascade');
                $table->integer('content_page_id')->unsigned()->nullable();
                $table->foreign('content_page_id', 'fk_p_164426_164424_conten_5b099bf7d0ee4')->references('id')->on('content_pages')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_category_content_page');
    }
}
