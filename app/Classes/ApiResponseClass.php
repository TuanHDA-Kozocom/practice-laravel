<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ApiResponseClass
{
    public static function set200Response($result, $code = 200)
    {
        $response = [
            'data' => $result
        ];
        return response()->json($response, $code);

    }

    public static function set400Response($message, $code=400) {
        return response()->json(['msg' => 'Do not register successfully'], 211);
    }

    public static function throw($e, $message = "Something went wrong! Process not completed")
    {
        Log::info($e);
        throw new HttpResponseException(response()->json(["message" => $message], 500));
    }

    public static function rollback($e, $message = "Something went wrong! Process not completed")
    {
        DB::rollBack();
        self::throw($e, $message);
    }

}
