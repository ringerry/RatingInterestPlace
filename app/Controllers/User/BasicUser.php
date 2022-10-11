<?php

namespace App\Controllers\User;

use App\Controllers\BaseControllerAbstract;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class BasicUser extends BaseControllerAbstract
{
    protected function GetUserId()
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getHeader("Authorization");
        $token = null;

        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
        }

        $decoded = (array)JWT::decode($token, new Key($key, 'HS256'));

        $modelU = new UserModel();

        return $modelU->where('email',$decoded['email'])->first()['id'];
    }

    protected function index()
    {
        //
    }
}
