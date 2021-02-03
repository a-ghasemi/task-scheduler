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
        $developers = [//level,work
            'Dev1' => [1,1],
            'Dev2' => [2,1],
            'Dev3' => [3,1],
            'Dev4' => [4,1],
            'Dev5' => [5,1],
        ];

        foreach($developers as $title => $properties){
            Developer::create([
                'title' => $title,
                'level' => $properties[0],
                'work' => $properties[1],
            ]);
        }
    }
}
