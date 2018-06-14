<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528065786RolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            if(Schema::hasColumn('roles', 'price')) {
                $table->dropColumn('price');
            }
            if(Schema::hasColumn('roles', 'stripe_plan_id')) {
                $table->dropColumn('stripe_plan_id');
            }
            if(Schema::hasColumn('roles', 'stripe_customer_id')) {
                $table->dropColumn('stripe_customer_id');
            }
            if(Schema::hasColumn('roles', 'role_until')) {
                $table->dropColumn('role_until');
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
        Schema::table('roles', function (Blueprint $table) {
                        $table->decimal('price', 15, 2)->nullable();
                $table->string('stripe_plan_id')->nullable();
                $table->string('stripe_customer_id')->nullable();
                $table->datetime('role_until')->nullable();
                
        });

    }
}
