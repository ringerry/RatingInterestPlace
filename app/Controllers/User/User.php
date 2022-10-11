<?php

namespace App\Controllers\User;

use App\Controllers\BaseControllerAbstract;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends BasicUser
{
    use ResponseTrait;

    public function index()
    {
        $users = new UserModel;
        return $this->respond(['users' => $users->findAll()], 200);
    }
}