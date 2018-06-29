<?php
/**
 * Created by PhpStorm.
 * User: yancey
 * Date: 2018/6/22
 * Time: 16:28
 */
namespace App\Service;



use App\Jobs\TestJob;
use App\Model\Testnum;

class TestService {



    private $id;
    private $name;
    private $title;
    private $num;
    private $testNumMod;




    public function __construct()
    {
        //todo balabala
        $this->testNumMod = new Testnum();


    }



    public function __set($name, $value)
    {
        $this->$name = $value;
    }



    public function testGet(){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'title'=>$this->title,
            'num'=>$this->num
        ];
    }


    public function testQueueIn(){

       $this->testNumMod->addSum(1,2);
//队列测试
//        return TestJob::dispatch($this->id,$this->num)->onQueue('aaa')
//            ->delay(now()->addSecond(5));
    }

    public function testQueueIn2(){

        $this->testNumMod->addSum2(1,1);

    }



}