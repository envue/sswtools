<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527346884TimeEntriesTable extends Migration
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
Schema::table('time_entries', function (Blueprint $table) {
            
if (!Schema::hasColumn('time_entries', 'description')) {
                $table->string('description')->nullable();
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
            $table->dropColumn('description');
            
        });
Schema::table('time_entries', function (Blueprint $table) {
                        
        });

    }
}
