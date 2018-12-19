<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Service\FengkongService;
use Illuminate\Support\Facades\Log;

class FengkongAuto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected      $id;
    public         $tries = 5;     //重试次数
    public         $timeout = 300; //超时时间

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        //$this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Log::info('已执行队列在这台：1-》');
       // $fengkong = new FengkongService($this->id);
       // Log::info(__FUNCTION__ . __LINE__ . ',风控队列已执行,', ['result'=>$fengkong]);
        sleep(0.1);
    }
}
