<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528123012TeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            if(Schema::hasColumn('teams', 'created_by_id')) {
                $table->dropForeign('163892_5b1475a3537cc');
                $table->dropIndex('163892_5b1475a3537cc');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('teams', 'created_by_team_id')) {
                $table->dropForeign('163892_5b1475a35fb54');
                $table->dropIndex('163892_5b1475a35fb54');
                $table->dropColumn('created_by_team_id');
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
        Schema::table('teams', function (Blueprint $table) {
                        
        });

    }
}
