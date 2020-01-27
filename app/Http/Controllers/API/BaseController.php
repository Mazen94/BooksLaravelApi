<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message){
        $response = [
            'sucess' => true ,
            'data' => $result,
            'message' => $message
        ]; 
        return response()->json($response,200);      
    }

    //Function elle retourne l'erreur
    public function sendError($error, $errormessage = []){
        $response = [
            'sucess' => false ,
            
            'message' => $error
        ];
         if(!empty($errormessage)){
             $response['data'] = $errormessage;
         }
         return response()->json($response,  404);
    }
}
