<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Controllers\RootController;
use App\Models\CityModel;
use App\Models\PlaceModel;
use App\Models\UserModel;

class Delete extends BasicUser
{
    public function index()
    {
        try {
            $model = new UserModel();

            $id = $this->request->getVar('id');


            $this->delete($model,$this->GetUserId());

            $res = [
                'message'=>'Пользователь удалён.',
            ];

            return $this->respond($res, 200);
        }
        catch (\Exception $e)
        {
            $res = [
                'errors'=> $e->getMessage(),
                'message'=>'Ошибка.',
            ];

            return $this->respond($res, 400);
        }
    }
}
