<?php
/**
 * Created by PhpStorm.
 * User: yancey
 * Date: 2018/6/22
 * Time: 16:28
 */
namespace App\Service;


class TestService {



    private $id;
    private $name;
    private $title;




    public function __construct()
    {
        //todo balabala


    }



    public function __set($name, $value)
    {
        $this->$name = $value;
    }



    public function testGet(){
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'title'=>$this->title
        ];
    }



}