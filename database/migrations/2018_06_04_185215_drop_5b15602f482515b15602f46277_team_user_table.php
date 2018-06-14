<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b15602f482515b15602f46277TeamUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('team_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('team_user')) {
            Schema::create('team_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id', 'fk_p_163892_159400_user_t_5b1476f3b709a')->references('id')->on('teams');
                $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_p_159400_163892_team_u_5b1476f3b5211')->references('id')->on('users');
                
                $table->timestamps();
                
            });
        }
    }
}
