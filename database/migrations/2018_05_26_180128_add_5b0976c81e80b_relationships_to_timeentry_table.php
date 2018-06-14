<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0976c81e80bRelationshipsToTimeEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_entries', function(Blueprint $table) {
            if (!Schema::hasColumn('time_entries', 'work_type_id')) {
                $table->integer('work_type_id')->unsigned()->nullable();
                $table->foreign('work_type_id', '159405_5afbab848ed23')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('time_entries', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '159405_5b079e062f004')->references('id')->on('teams')->onDelete('cascade');
                }
                if (!Schema::hasColumn('time_entries', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '159405_5b01a0a2acce6')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('time_entries', 'population_id')) {
                $table->integer('population_id')->unsigned()->nullable();
                $table->foreign('population_id', '159405_5b0976c502f98')->references('id')->on('time_populations')->onDelete('cascade');
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
        Schema::table('time_entries', function(Blueprint $table) {
            
        });
    }
}
