<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\CityUserModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class CitiesByUser extends BasicUser
{
    use ResponseTrait;

    public function index()
    {
        try {
            $modelC = new CityModel();
            $modelCU = new CityUserModel();
            $citiesIdArr = $modelCU->where('user_id',$this->GetUserId())->
            findColumn('city_town_id');


            $res = [
                'message' => 'Города.',
                'response' => $modelC->whereIn('id',$citiesIdArr)->findAll(),
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
