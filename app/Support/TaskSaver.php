<?php

namespace App\Support;


use App\Models\Task;

class TaskSaver
{
    private $adaptor;

    public function setAdaptor(ProviderAdaptor $adaptor): void
    {
        $this->adaptor = $adaptor;
    }

    public function execute(): array
    {
        $count = 0;
        try {
            foreach ($this->adaptor->getValues() as $task) {
                $task_exists = Task::where('provider_id', $this->adaptor->provider_id)
                        ->where('name', $task['name'])
                        ->count() > 0;

                #todo: we have to add another process if provider should be able to update tasks details.
                if ($task_exists) continue;

                Task::create($task);
                $count++;
            }
        } catch (\Exception $e) {
            return ['success' => 'false', 'message' => $e->getMessage()];
        }

        return ['success' => true, 'count' => $count];
    }
}