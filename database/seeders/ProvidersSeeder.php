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
                      '5d47f235330000623fa3ebf7' => 'https://www.mediaclick.com.tr/api/5d47f235330000623fa3ebf7.json',
                      '5d47f24c330000623fa3ebfa' => 'https://www.mediaclick.com.tr/api/5d47f24c330000623fa3ebfa.json',
        ];

        foreach ($providers as $slag => $url) {
            TaskProvider::create([
                'provider_slag' => $slag,
                'url'           => $url,
            ]);
        }
    }
}
