<?php

namespace App\Controllers\Place;

use App\Controllers\BaseControllerAbstract;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use CodeIgniter\API\ResponseTrait;
use function PHPUnit\Framework\isEmpty;

class Update extends BaseControllerAbstract
{
    use ResponseTrait;

    private function AddIfNotNull($data,$field)
    {
        if(!is_null($this->request->getVar($field)))
        {
            $data[$field] = $this->request->getVar($field);
        }

        return $data;
    }

    public function index()
    {
        try {
            $rules = [
                'id' => ['rules' => 'required'],
            ];

            if($this->validate($rules))
            {
                $model = new PlaceModel();
                $data = [];

                $data = $this->AddIfNotNull($data,'name');
                $data = $this->AddIfNotNull($data,'to_center');
                $data = $this->AddIfNotNull($data,'rating');

                $model->update($this->request->getVar('id'),$data);

                $data = [];
                $data = $this->AddIfNotNull($data,'city_id');

                if(count($data)!=0)
                {
                    $model = new PlaceCityModel();

                    $res = $model->where('place_id',$this->request->getVar('id'))->first();

                    $res1 = [
                        'city_town_id' => $this->request->getVar('city_id'),
                    ];

                    $model->update($res['id'],$res1);
                }

                $res = [
                    'message' => 'Достопримечательность обновлена.',
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
