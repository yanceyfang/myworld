<?php

namespace App\Jobs;

use App\Model\Testnum;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;
    private $num;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id,$num)
    {
        //
        $this->id = $id;
        $this->num = $num;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Log::info('1现数量为：',[$this->num]);
        DB::insert('insert into dump_order(no,laiyuan) value (?,?)',[$this->num,$this->id]);



    }
}
