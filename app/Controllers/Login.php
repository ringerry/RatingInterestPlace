<?php

namespace App\Controllers;

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DeveloperModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if(is_null($user)) {
            return $this->respond(['error' => 'Данный пользователь не найден.'], 401);
        }

        $pwd_verify = password_verify($password, $user['password']);

        if(!$pwd_verify) {
            return $this->respond(['error' => 'Пароль неправильный.'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time();
        //$exp = $iat + 5400;
        $exp = $iat + 540000000;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat,
            "exp" => $exp,
            "email" => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Успешный вход.',
            'token' => $token
        ];

        return $this->respond($response, 200);
    }
}
