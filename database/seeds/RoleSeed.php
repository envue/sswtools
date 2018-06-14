<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator', 'price' => null, 'stripe_plan_id' => null,],
            ['id' => 5, 'title' => 'Team Admin', 'price' => null, 'stripe_plan_id' => null,],
            ['id' => 6, 'title' => 'User', 'price' => null, 'stripe_plan_id' => null,],
            ['id' => 8, 'title' => 'Premium User', 'price' => '19.99', 'stripe_plan_id' => 'premium_user',],
            ['id' => 9, 'title' => 'Premium Team Admin', 'price' => '49.99', 'stripe_plan_id' => 'premium_team_admin',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
