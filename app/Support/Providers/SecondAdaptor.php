<?php
/**
 * Data map:
 *
 *
 *
 */

namespace App\Support\Providers;


use App\Support\ProviderAdaptor;

class SecondAdaptor extends ProviderAdaptor
{
    public function getValues(){
        foreach($this->items as $details){
            $task = [
                'provider_id' => $this->provider_id,
                'name' => $details->id,
                'duration' => $details->sure,
                'level' => $details->zorluk,
            ];

            yield $task;
        }
   }
}