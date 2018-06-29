<?php

namespace App\Http\Controllers\Test;

use App\Jobs\TestJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class TestController extends Controller
{


    /**
     * @param Request $request
     * @return string
     *
     */
    //自动循环模拟并发
    public function test1(Request $request){

        //并发循环实验  /test/v1/test1?oor=1
        while(($num = Redis::decr('num'))>=0){

            TestJob::dispatch($request->get('oor'),$num)->onQueue('miaosha');
            echo Redis::get('num');
        }
        //做库存归零操作，防止负数
        if(Redis::get('num') < 0) Redis::set('num',0);
    }

    //手动抢看效果  /test/v1/test2?oor=4
    public function test2(Request $request){

        if(($num = Redis::decr('num'))>=0){
            TestJob::dispatch($request->get('oor'),$num)->onQueue('miaosha');
            echo '抢到了编号是：'.$num;
        }else{
            //做库存归零操作，防止负数
            if(Redis::get('num') < 0) Redis::set('num',0);
            echo '抢完了，没抢到';
        }
    }





}
