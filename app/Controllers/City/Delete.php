<?php

namespace App\Controllers\City;

use App\Controllers\BaseControllerAbstract;
use App\Models\CityModel;
use CodeIgniter\API\ResponseTrait;
use function PHPUnit\Framework\throwException;

class Delete extends BaseControllerAbstract
{
    use ResponseTrait;

    private function delete($model,$id)
    {
        if(is_null($model->where('id',$id)->first()))
        {
            throw new \Exception("Города с id".$id." не существует.");
        }

        $model->delete($id);

    }

    public function index()
    {
        $res = [];

        try {
            $model = new CityModel();

            $id = $this->request->getVar('id');

            if(is_null($id))
            {
                $city = $model->where('name',$this->request->getVar('name'))->first();
                if(is_null($city))
                {
                    throw new \Exception("Города ".$this->request->getVar('name'). " не существует.");
                }
                $id = $model->where('name',$this->request->getVar('name'))->first()['id'];
            }

            $this->delete($model,$id);

            $res["message"] = "Город удалён.";

            return $this->respond($res, 200);
        }
        catch (\Exception $e)
        {
            $res["message"] = $e->getMessage();
            return $this->respond($res, 400);
        }
    }
}
