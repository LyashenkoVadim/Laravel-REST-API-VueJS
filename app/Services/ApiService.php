<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class ApiService
{
    public static function PerPageHandler($request){

        if($request->per_page){
            if(ctype_digit($request->per_page)){
                $per_page = (int)$request->per_page;
                return $per_page;
            }
            else{
                return response('Error: per_page must be a positive number', Response::HTTP_BAD_REQUEST);
            }
        }
        else{
            return false;
        }

    }


}
