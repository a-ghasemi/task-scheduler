<?php

namespace Database\Seeders;

use App\Models\TaskProvider;
use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providers = [//$url
                      '5d47f235330000623fa3ebf7' => [
                          'url'  => 'https://www.mediaclick.com.tr/api/5d47f235330000623fa3ebf7.json',
                          'type' => 'firstType',
                      ],
                      '5d47f24c330000623fa3ebfa' => [
                          'url'  => 'https://www.mediaclick.com.tr/api/5d47f24c330000623fa3ebfa.json',
                          'type' => 'secondType',
                      ],
        ];

        foreach ($providers as $slag => $details) {
            TaskProvider::create([
                'provider_slag' => $slag,
                'url'           => $details['url'],
                'type'          => $details['type'],
            ]);
        }
    }
}
