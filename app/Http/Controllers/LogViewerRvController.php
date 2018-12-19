<?php
 namespace App\Http\Controllers;

 use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;
 use Arcanedev\LogViewer\Http\Controllers\LogViewerController;
 use Illuminate\Http\Request;

 class LogViewerRvController extends LogViewerController{



     public function __construct(LogViewerContract $logViewer)
     {
         parent::__construct($logViewer);
     }



     public function index(){
       return  parent::index();
     }



     public function listLogs(Request $request)
     {


         return  parent::listLogs();
     }

 }