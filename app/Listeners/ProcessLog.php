<?php

namespace App\Listeners;

use App\Events\RequestProcess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ProcessLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RequestProcess  $event
     * @return void
     */
    public function handle(RequestProcess $event)
    {
        //
        $info  = 'source：(';
        $info .= $event->rt;
        $info .= ') type：(';
        $info .= $event->c;
        $info .= ') data：';
        Log::channel('process')->info($info,$event->data);
    }
}
