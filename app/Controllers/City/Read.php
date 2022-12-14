<?php

namespace App\Controllers\City;

use App\Controllers\BaseController;
use App\Models\CityModel;
use CodeIgniter\API\ResponseTrait;

class Read extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $res = [];

        try {
            $model = new CityModel();

            $res["message"] = "Города.";
            $res["response"] = $model->findAll();

            return $this->respond($res, 200);
        }
        catch (\Exception $e)
        {
            $res["message"] = $e->getMessage();
            return $this->respond($res, 400);
        }
    }
}
