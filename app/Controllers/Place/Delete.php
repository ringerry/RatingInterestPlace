<?php

namespace App\Controllers\Place;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use CodeIgniter\API\ResponseTrait;

class Delete extends BaseController
{
    use ResponseTrait;

    private function delete($model,$model2,$id)
    {
        if(is_null($model->where('id',$id)->first()))
        {
            throw new \Exception("Достопримечательности с id ".$id." не существует.");
        }

        $placeCityId = $model2->where('place_id',$id)->first()['id'];
        $model->delete($id);
        // Из вспомогательной таблицы.
        $model2->delete($placeCityId);
    }

    public function index()
    {
        try {
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');

            if(is_null($id)&&is_null($name))
            {
                throw new \Exception("Название или id обязательно.");
            }

            $model = new PlaceModel();

            if(is_null($id))
            {
                $place = $model->where('name',$this->request->getVar('name'))->first();
                if(is_null($place))
                {
                    throw new \Exception("Достопримечательности ".
                        $this->request->getVar('name'). " не существует.");
                }
                $id = $model->where('name',$this->request->getVar('name'))->first()['id'];
            }
            $model2 = new PlaceCityModel();
            $this->delete($model,$model2,$id);

            $res = [
                'message' => 'Достопримечательность удалена.',
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
