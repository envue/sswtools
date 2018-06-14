<?php

use Illuminate\Database\Seeder;

class TimeProjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'General Education',],
            ['id' => 2, 'name' => 'Special Education',],
            ['id' => 3, 'name' => 'Mixed',],

        ];

        foreach ($items as $item) {
            \App\TimeProject::create($item);
        }
    }
}
