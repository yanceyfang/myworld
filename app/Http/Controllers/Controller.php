<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function SUCCESS($info,$status = "SUCCESS"){
        $data = array();
        $data['code'] = '200';
        $data['status'] = $status;
        $data['datas'] = $info;
        return json_encode($data) ;
    }

}
