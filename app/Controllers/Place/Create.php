<?php

namespace App\Controllers\Place;

use App\Controllers\BaseControllerAbstract;
use App\Models\CityModel;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
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
                'to_center' => ['rules' => 'required'],
                'city_id' => ['rules' => 'required'],
            ];

            if($this->validate($rules))
            {
                $model = new PlaceModel();
                $data = [
                    'name'    => $this->request->getVar('name'),
                    'to_center'    => $this->request->getVar('to_center'),
                    'rating'    => $this->request->getVar('rating'),
                ];

                $id = $model->insert($data);

                $model = new PlaceCityModel();
                $data1 = [
                    'place_id'    => $id,
                    'city_town_id'    => $this->request->getVar('city_id'),
                ];

                $id = $model->insert($data1);

                $res = [
                    'message' => "Достопримечательность ".$data['name']." добавлена.",
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
            $res = [
                'errors'=> $e->getMessage(),
                'message'=>'Ошибка.',
            ];
            return $this->respond($res, 400);
        }
    }
}
