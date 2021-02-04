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
                          'type' => 'FirstAdaptor',
                      ],
                      '5d47f24c330000623fa3ebfa' => [
                          'url'  => 'https://www.mediaclick.com.tr/api/5d47f24c330000623fa3ebfa.json',
                          'type' => 'SecondAdaptor',
                      ],
        ];

        foreach ($providers as $slag => $details) {
            TaskProvider::create([
                'slag'    => $slag,
                'url'     => $details['url'],
                'adaptor' => $details['type'],
            ]);
        }
    }
}
