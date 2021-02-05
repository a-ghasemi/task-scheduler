<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers = [//level,work,work time per week
            'Dev1' => [1,1,45],
            'Dev2' => [2,1,45],
            'Dev3' => [3,1,45],
            'Dev4' => [4,1,45],
            'Dev5' => [5,1,45],
        ];

        foreach($developers as $title => $properties){
            Developer::create([
                'title' => $title,
                'level' => $properties[0],
                'work' => $properties[1],
                'per_week' => $properties[2],
            ]);
        }
    }
}
