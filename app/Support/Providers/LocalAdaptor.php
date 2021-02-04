<?php
/**
 * Data map:
 *
 *
 *
 */

namespace App\Support\Providers;


use App\Support\ProviderAdaptor;

class LocalAdaptor extends ProviderAdaptor
{
    public function getValues(){
        foreach($this->items as $index => $details){
            $task = [
                'provider_id' => $this->provider_id,
                'name' => $index,
                'level' => $details[0],
                'duration' => $details[1],
            ];

            yield $task;
        }
   }
}