<?php 
 namespace App\Util;
 use Illuminate\Http\Response;

    class ResponseFormat {

        public static function Response($success,$status,$message=null,$data=null){
             return Response()->json([
                 "success"=>$success,
                 "status"=> $status,
                 "message"=>$message,
                 "data"=>$data
             ],$status);
        }

    }