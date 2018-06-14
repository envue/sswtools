<?php

use Illuminate\Database\Seeder;

class TimeWorkTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Direct',],
            ['id' => 2, 'name' => 'Indirect',],
            ['id' => 3, 'name' => 'Crisis',],
            ['id' => 4, 'name' => 'Documentation',],
            ['id' => 5, 'name' => 'Meeting',],
            ['id' => 6, 'name' => 'Assessment',],
            ['id' => 7, 'name' => 'Pre-Intervention',],
            ['id' => 8, 'name' => 'School Wide Prevention',],
            ['id' => 9, 'name' => 'Professional Development',],
            ['id' => 10, 'name' => 'Supervision/Mentor',],
            ['id' => 11, 'name' => 'Travel',],
            ['id' => 12, 'name' => 'Other',],

        ];

        foreach ($items as $item) {
            \App\TimeWorkType::create($item);
        }
    }
}
