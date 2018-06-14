<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5afc476286d12FaqQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('faq_questions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('faq_questions')) {
            Schema::create('faq_questions', function (Blueprint $table) {
                $table->increments('id');
                $table->text('question_text');
                $table->text('answer_text');
                
                $table->timestamps();
                
            });
        }
    }
}
