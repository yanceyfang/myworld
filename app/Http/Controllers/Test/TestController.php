<?php

namespace App\Http\Controllers\Test;

use App\Jobs\ProcessPodcast;
use App\Service\TestService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{


    /**
     * @param Request $request
     * @return string
     *
     */
    public function test1(Request $request){

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






        return  self::SUCCESS(1);
    }

    public function test2(){
        $testService = new TestService();


        return 'test2';

    }





}
