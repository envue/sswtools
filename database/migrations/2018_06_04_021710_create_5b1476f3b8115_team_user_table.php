<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b1476f3b8115TeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('team_user')) {
            Schema::create('team_user', function (Blueprint $table) {
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', 'fk_p_163892_159400_user_t_5b1476f3b822a')->references('id')->on('teams')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_159400_163892_team_u_5b1476f3b82b5')->references('id')->on('users')->onDelete('cascade');
                
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
        Schema::dropIfExists('team_user');
    }
}
