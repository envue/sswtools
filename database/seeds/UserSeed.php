<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Scott Carchedi', 'email' => 'scott@envuestudios.com', 'password' => '$2y$10$49lhHc3ffKDmBgmkukg1p.0JyeICZFvgxpBdehtyxaxkxA4Uvk6fW', 'role_id' => 1, 'remember_token' => '', 'stripe_customer_id' => null, 'role_until' => '',],
            ['id' => 2, 'name' => 'admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$S60fqJfgDobI0k4bmyw/TOCnwciHi/jd/c.6l1fKppuklWzt1awqO', 'role_id' => 1, 'remember_token' => null, 'stripe_customer_id' => null, 'role_until' => '',],
            ['id' => 3, 'name' => 'demouser', 'email' => 'demo@demo.com', 'password' => '$2y$10$5XQCWoq7uPK4T0SeU/opc.WIV4R8xb3.mxBUinMTghfwrAlcN8bRq', 'role_id' => 6, 'remember_token' => null, 'stripe_customer_id' => null, 'role_until' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
