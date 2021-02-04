<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class FormatData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:level';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Group by tasks on level with sum of duration';

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
        $tasks = Task::groupBy('level')
            ->selectRaw('sum(duration) as sum, level')
            ->pluck('sum','level');
        dd($tasks);
    }
}
