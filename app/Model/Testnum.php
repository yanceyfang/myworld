<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Testnum extends Model
{
    //
    protected $table = 'testnum';



//并发实验
    public function addSum($id,$num){
        DB::beginTransaction();
        $row = self::lockForUpdate()
            ->find($id);
        sleep(5);
        $row->num = $row->num-$num;
        $row->save();


        DB::commit();
    }
    public function addSum2($id,$num){
        DB::beginTransaction();
        $row = self::lockForUpdate()
            ->find($id);
        $row->num = $row->num-$num;
        $row->save();

        DB::commit();
    }


}
