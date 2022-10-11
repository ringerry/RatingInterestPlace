<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\CityUserModel;
use App\Models\DeveloperModel;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use App\Models\PlaceUserModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Rating extends BaseController
{
    use ResponseTrait;

    private $dbg='';

    private function UpdateCities()
    {


        $modelPS = new PlaceCityModel();
        $cityId = $modelPS->where('place_id',$this->request->getVar('place_id'))->first()['city_town_id'];

        $modelCU = new CityUserModel();
        $data = [
            'user_id'    => $this->GetUserId(),
            'city_town_id'    => $cityId,
        ];

        if(is_null($modelCU->where('user_id',$this->GetUserId())->where('city_town_id',$cityId)->first()))
        {
            $modelCU->insert($data);
        }
    }

    private function UpdatePlaceRating()
    {
        $modelPU = new PlaceUserModel();
        $marks = $modelPU->where('place_id',$this->request->getVar('place_id'))->findAll();

        $total = 0;

        foreach ($marks as $mark)
        {
            $total+=$mark['user_rating'];
        }

        $curRating = round($total/count($marks),2);

        $data = [
            'id'=>$this->request->getVar('place_id'),
            'rating' => $curRating
        ];

        $modelP = new PlaceModel();
        $modelP->save($data);
    }

    private function RatePlace()
    {
        $modelPU = new PlaceUserModel();
        $data = [
            'user_rating'    => $this->request->getVar('rating'),
            'user_id'    => $this->GetUserId(),
            'place_id'    => $this->request->getVar('place_id'),
        ];

        $curRate = $modelPU->where('user_id',$this->GetUserId())->
        where('place_id',$this->request->getVar('place_id'))->first();

        if(is_null($curRate))
        {

            $modelPU->insert($data);
        }
        else{
            $pUId = $curRate['id'];

            $modelPU->update($pUId,$data);
        }
    }

    private function GetUserId()
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getHeader("Authorization");
        $token = null;

        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
        }

        $decoded = (array)JWT::decode($token, new Key($key, 'HS256'));

        $modelU = new UserModel();

        return $modelU->where('email',$decoded['email'])->first()['id'];
    }

    public function index()
    {
        try {
            $rules = [
                'rating' => ['rules' => 'required|less_than[11]|greater_than[0]|integer'],
                'place_id' => ['rules' => 'required'],
            ];

            if($this->validate($rules))
            {

                $this->RatePlace();
                $this->UpdateCities();
                $this->UpdatePlaceRating();

                $res = [
                    'message' => 'Оценка успешно добавлена.',
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
                'errors'=> $e->getLine(),
                'message'=>'Ошибка.',
            ];

            return $this->respond($res, 400);
        }
    }
}
