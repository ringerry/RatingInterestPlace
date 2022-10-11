<?php

namespace App\Controllers\City;

use App\Controllers\BaseController;
use App\Models\CityUserModel;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UsersByCity extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {

            $rules = [
                'id' => ['rules' => 'required'],
            ];

            if($this->validate($rules))
            {
                $modelU = new UserModel();
                $modelCU = new CityUserModel();
                $userIdArr = $modelCU->where('city_town_id',$this->request->getVar('id'))->
                findColumn('user_id');


                $res = [
                    'message' => 'Пользователи.',
                    'response' => $modelU->whereIn('id',$userIdArr)->findAll(),
                ];

                return $this->respond($res, 200);
            }
            else
            {
                $response = [
                    'errors' => $this->validator->getErrors(),
                    'message' => 'Данные ошибочны.'
                ];
                return $this->fail($response , 409);
            }
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
