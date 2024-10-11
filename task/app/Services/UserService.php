<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public static function loadUserJsonData($path)
    {
        $json = file_get_contents($path);
        $data = json_decode($json, true);

        return $data;
    }

}
