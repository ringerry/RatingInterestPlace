<?php

namespace App\Controllers\City;

use App\Controllers\BaseControllerAbstract;
use App\Models\CityModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Create extends BaseControllerAbstract
{
    use ResponseTrait;

    public function index()
    {
        $res = [
            "message" => "",
        ];

        try {
            $rules = [
                'name' => ['rules' => 'required'],
            ];

            if($this->validate($rules))
            {
                $model = new CityModel();
                $data = [
                    'name'    => $this->request->getVar('name'),
                ];

                $id = $model->insert($data);

                $res = [
                    'message' => "Город ".$data['name']." добавлен.",
                    'id' => $id,
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
            $res["message"] = $e->getMessage();
            return $this->respond($res, 400);
        }
    }
}
