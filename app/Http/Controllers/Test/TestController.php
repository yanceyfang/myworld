<?php

namespace App\Http\Controllers\Test;

use App\Jobs\ProcessPodcast;
use App\Service\TestService;
use App\Services\OSS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{


    /**
     * @param Request $request
     * @return string
     *
     */
    public function test1(Request $request){
//端：模块：功能：数据类型：键名
//        $testService = new TestService();
//        $testService->__set('id',$request->input('id'));
//        $testService->__set('name',$request->input('name'));
//        $testService->__set('title',$request->input('title'));
//
//
//        ProcessPodcast::dispatch()->onQueue('Preferred');
//        ProcessPodcast::dispatch()->onQueue('Reserve');
//        ProcessPodcast::dispatch();
//        $data = $testService->testGet();
//        Redis::set("loan:test:test1:str:status","1");
//        Redis::lpush("loan:test:test1:list:status","1");
//        Redis::hmset("loan:test:test1:hash:hotUserInfo",'133','2');
//        Redis::zadd("loan:test:test1:zset:hotUserInfo",1,'133');
       //var_dump(Redis::sadd("keySet:list","loan:test:test1:zset:hotUserInfo"));
//       检查给定键名是否在keys集合中
//       var_dump(Redis::sismember("keySet:list","loan:test:test1:zset:hotUserInfo"));
        //$request->session()->put('key', '111');
      //  $request->session()->forget('key');

        //return  self::SUCCESS(1);
        // 建立socket连接到内部推送端口
        $client = stream_socket_client('tcp://118.25.93.110:5678', $errno, $errmsg, 1);
// 推送的数据，包含uid字段，表示是给这个uid推送
        $data = array('uid'=>'uid1', 'msg'=>$request->input('msg'));
// 发送数据，注意5678端口是Text协议的端口，Text协议需要在数据末尾加上换行符
        fwrite($client, json_encode($data)."\n");
// 读取推送结果
        echo fread($client, 8192);

    }

    public function test2(){
      //  $testService = new TestService();
        $fo = fopen('/data/www/laravel-test/storage/logs/qianjinjia-2018-11-06.log','r');
        $rowsstr = "";
        $autoscriptarray = [];
        while(! feof($fo)){
            $row = fgets($fo);
                if(strstr($row,'[2018-')){
                    array_push($autoscriptarray,$rowsstr);
                    $rowsstr = "";
                    $rowsstr .= $row;
                }else{
                    $rowsstr .= $row;
                }
        }
        var_dump($autoscriptarray);
        fclose($fo);


    }

    public function test3(){
        $a = OSS::publicUpload('qianjinjia-test',"idcard/1111.txt","/data/www/laravel-test/storage/logs/laravel-2018-11-19.log");
        return var_dump($a);
    }





}
