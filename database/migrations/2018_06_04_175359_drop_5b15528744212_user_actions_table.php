<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b15528744212UserActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_actions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('user_actions')) {
            Schema::create('user_actions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('action');
                $table->string('action_model')->nullable();
                $table->integer('action_id')->nullable();
                
                $table->timestamps();
                
            });
        }
    }
}
