<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527460417TimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_entries', function (Blueprint $table) {
            if(Schema::hasColumn('time_entries', 'project_id')) {
                $table->dropForeign('159405_5afbab849ab1d');
                $table->dropIndex('159405_5afbab849ab1d');
                $table->dropColumn('project_id');
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
        Schema::table('time_entries', function (Blueprint $table) {
                        
        });

    }
}
