<?php

namespace App\Http\Controllers\Test;

use App\Events\RequestProcess;
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

       event(new RequestProcess(json_decode('{"mchnt_cd":"0002900F0282229","mchnt_txn_ssn":"201806201548195085","login_id":"18593040082","mobile":"18593040082","page_notify_url":"http://api.mymoneygohome.com/loan/v403/bankSignNotify","signature":"LWKyNGpGLCRVAfzzy22uBvmjPmsYrxOMK4560KiNR5EgNAHU+ByeayOzLsvatphpK+oNUWnd18tNlf81dIXInkFZNdwKFpUPqmLFI31tEhkbisMZr8Qq9N4LtwAqoAjTQvMmh+kbsewj5oUCW0wcTiv62GNTqZpAdKrD7MLWMj0=","api_url":"https://jzh.fuiou.com/app/appSign_card.action"}',true),'FY','CALLBACK'));
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
