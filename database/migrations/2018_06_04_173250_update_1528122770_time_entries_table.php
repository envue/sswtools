<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528122770TimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_entries', function (Blueprint $table) {
            if(Schema::hasColumn('time_entries', 'population_id')) {
                $table->dropForeign('159405_5b0976c502f98');
                $table->dropIndex('159405_5b0976c502f98');
                $table->dropColumn('population_id');
            }
            if(Schema::hasColumn('time_entries', 'caseload_student')) {
                $table->dropColumn('caseload_student');
            }
            
        });
Schema::table('time_entries', function (Blueprint $table) {
            
if (!Schema::hasColumn('time_entries', 'population_type')) {
                $table->string('population_type')->nullable();
                }
if (!Schema::hasColumn('time_entries', 'caseload')) {
                $table->string('caseload')->nullable();
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
            $table->dropColumn('population_type');
            $table->dropColumn('caseload');
            
        });
Schema::table('time_entries', function (Blueprint $table) {
                        $table->tinyInteger('caseload_student')->nullable()->default('0');
                
        });

    }
}
