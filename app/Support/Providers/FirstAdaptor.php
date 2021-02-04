<?php
/**
 * Data map:
 *
 *
 *
 */

namespace App\Support\Providers;


use App\Support\ProviderAdaptor;

class FirstAdaptor extends ProviderAdaptor
{
    public function getValues(){
        foreach($this->items as $item){
            foreach($item as $name => $details){
                $task = [
                    'provider_id' => $this->provider_id,
                    'name' => $name,
                    'duration' => $details->estimated_duration,
                    'level' => $details->level,
                ];

                yield $task;
            }
        }
    }
}