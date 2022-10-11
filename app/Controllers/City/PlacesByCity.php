<?php

namespace App\Controllers\City;

use App\Controllers\BaseControllerAbstract;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use CodeIgniter\API\ResponseTrait;

class PlacesByCity extends BaseControllerAbstract
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
                $modelP = new PlaceModel();
                $modelPC = new PlaceCityModel();
                $placesId = $modelPC->where('city_town_id',$this->request->getVar('id'))->
                    findColumn('place_id');


                $res = [
                    'message' => 'Достопримечательности.',
                    'response' => $modelP->whereIn('id',$placesId)->findAll(),
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
