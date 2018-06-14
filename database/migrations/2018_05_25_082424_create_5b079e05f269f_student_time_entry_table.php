<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b079e05f269fStudentTimeEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('student_time_entry')) {
            Schema::create('student_time_entry', function (Blueprint $table) {
                $table->integer('student_id')->unsigned()->nullable();
                $table->foreign('student_id', 'fk_p_163908_159405_timeen_5b079e05f279d')->references('id')->on('students')->onDelete('cascade');
                $table->integer('time_entry_id')->unsigned()->nullable();
                $table->foreign('time_entry_id', 'fk_p_159405_163908_studen_5b079e05f2832')->references('id')->on('time_entries')->onDelete('cascade');
                
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
        Schema::dropIfExists('student_time_entry');
    }
}
