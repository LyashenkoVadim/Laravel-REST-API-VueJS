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
                return response()->json([
                    'errors' => 'per_page must be a positive number'
                ],Response::HTTP_BAD_REQUEST);
            }
        }
        else{
            return false;
        }

    }

    public static function PaginationHandler($per_page, $default, $entity, $resource){

        if(is_object($per_page)){
            return $per_page;
        }

        if($per_page){
            $entities = $entity::paginate($per_page);
        }
        else{
            $entities = $entity::paginate($default);
        }

        return $resource::collection($entities);
    }

}
