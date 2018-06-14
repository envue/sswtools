<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5b0968bc0aa725b0968bc08de5InternalNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('internal_notification_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('internal_notification_user')) {
            Schema::create('internal_notification_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('internal_notification_id')->unsigned()->nullable();
            $table->foreign('internal_notification_id', 'fk_p_159410_159400_user_i_5afbabb724915')->references('id')->on('internal_notifications');
                $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id', 'fk_p_159400_159410_intern_5afbabb723eab')->references('id')->on('users');
                
                $table->timestamps();
                
            });
        }
    }
}
