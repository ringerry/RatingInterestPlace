<?php

namespace App\Controllers\City;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Create extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $res = [
            "message" => "",
        ];

        try {
            $model = new CityModel();
            $data = [
                'name'    => $this->request->getVar('name'),
            ];
            $model->save($data);

            $res["message"] = "Город ".$data['name']." добавлен.";

            return $this->respond($res, 200);
        }
        catch (\Exception $e)
        {
            $res["message"] = $e->getMessage();
            return $this->respond($res, 400);
        }
    }
}
