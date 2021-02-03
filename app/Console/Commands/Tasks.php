<?php

namespace App\Console\Commands;

use App\Models\TaskProvider;
use Illuminate\Console\Command;

class Tasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:fetch {provider_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrives tasks from providers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $provider = TaskProvider::find($this->argument('provider_id'));
        if (empty($provider)) return 0;

        $tasks = $this->readUrl($provider->url);

        dd($tasks);
    }

    protected function readUrl($url)
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        return $jsonData;
    }
}
