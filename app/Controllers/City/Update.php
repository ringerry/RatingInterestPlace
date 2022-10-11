<?php

namespace App\Controllers\City;

use App\Controllers\BaseControllerAbstract;
use App\Models\CityModel;
use CodeIgniter\API\ResponseTrait;

class Update extends BaseControllerAbstract
{
    use ResponseTrait;

    public function index()
    {
        $res = [];

        try {
            $model = new CityModel();

            $data = ["name" => $this->request->getVar('name'),
            ];

            $model->update($this->request->getVar('id'),$data);

            $res["message"] = "Город обновлен.";

            return $this->respond($res, 200);
        }
        catch (\Exception $e)
        {
            $res["message"] = $e->getMessage();
            return $this->respond($res, 400);
        }
    }
}
