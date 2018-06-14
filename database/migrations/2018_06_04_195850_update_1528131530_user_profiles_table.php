<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528131530UserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            if(Schema::hasColumn('user_profiles', 'created_by_id')) {
                $table->dropForeign('168019_5b1561eed8bd9');
                $table->dropIndex('168019_5b1561eed8bd9');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('user_profiles', 'created_by_team_id')) {
                $table->dropForeign('168019_5b1561eee624e');
                $table->dropIndex('168019_5b1561eee624e');
                $table->dropColumn('created_by_team_id');
            }
            
        });
Schema::table('user_profiles', function (Blueprint $table) {
            
if (!Schema::hasColumn('user_profiles', 'title')) {
                $table->string('title')->nullable();
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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('title');
            
        });
Schema::table('user_profiles', function (Blueprint $table) {
                        
        });

    }
}
