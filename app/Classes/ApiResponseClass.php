<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function setResponse($result, $code = 200)
    {
        $response = [
            'data' => $result
        ];
        return response()->json($response, $code);

    }

    public static function throw($e, $message = "Something went wrong! Process not completed")
    {
        Log::info($e);
        //dd($e.);
        throw new HttpResponseException(response()->json(["message" => $message], 500));
    }

    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

}
