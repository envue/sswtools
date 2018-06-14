<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(ContentPageSeed::class);
        $this->call(RoleSeed::class);
        $this->call(TimeProjectSeed::class);
        $this->call(TimeWorkTypeSeed::class);
        $this->call(UserSeed::class);

    }
}
