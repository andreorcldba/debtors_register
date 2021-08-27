<?php

namespace App\Services;

class Utils
{
    public static function patchMethod(){
        parse_str(file_get_contents('php://input'), $_PATCH);
        $body=[];
        if (is_array($_PATCH)) {
            foreach ($_PATCH as $key => $value) {
                $body[$key] = $value;
            }
        }
        return $body;
    }
}