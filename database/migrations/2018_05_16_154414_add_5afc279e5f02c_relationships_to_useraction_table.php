<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5afc279e5f02cRelationshipsToUserActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_actions', function(Blueprint $table) {
            if (!Schema::hasColumn('user_actions', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '159401_5afbab5c6dc18')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('user_actions', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '159401_5afc279a64377')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_actions', function(Blueprint $table) {
            
        });
    }
}
