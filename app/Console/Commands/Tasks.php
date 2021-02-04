<?php

namespace App\Console\Commands;

use App\Models\TaskProvider;
use App\Support\TaskSaver;
use App\Support\Providers\FirstAdaptor;
use App\Support\Providers\SecondAdaptor;
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
        $provider_id = (int) $this->argument('provider_id');

        $provider = TaskProvider::find($provider_id);
        if (empty($provider)) return $this->error('Provider id ['.$provider_id.'] not found!');

        $this->comment("Provider Slag: ".$provider->slag);
        $this->comment("Provider URL: ".$provider->url);
        $this->comment("Provider Adaptor: ".$provider->adaptor);

        $adaptor_class = 'App\\Support\\Providers\\'.$provider->adaptor;
        $adaptor = new $adaptor_class($provider->id, $provider->url);

        $task_saver = new TaskSaver();
        $task_saver->setAdaptor($adaptor);
        $result = $task_saver->execute();

        if($result['success'] === FALSE){
            $this->error('Process failed');
            return $this->error($result['message']);
        }

        $this->comment('Process done');
        $this->comment('Added Tasks: ' . $result['count']);
    }

}
