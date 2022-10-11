<?php

namespace App\Controllers\Place;

use App\Controllers\BaseControllerAbstract;
use App\Models\CityModel;
use App\Models\PlaceModel;
use CodeIgniter\API\ResponseTrait;

class Read extends BaseControllerAbstract
{
    use ResponseTrait;

    public function index()
    {
        try {
            $model = new PlaceModel();

            $res = [
                'message' => 'Достопримечательности.',
                'response' => $model->findAll(),
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
