<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PlaceCityModel;
use App\Models\PlaceModel;
use App\Models\UserModel;

class Update extends BasicUser
{
    public function index()
    {
        try {
            $data = [];

            $data = $this->AddIfNotNull($data,'firstname');
            $data = $this->AddIfNotNull($data,'lastname');
            $data = $this->AddIfNotNull($data,'patronymic');
            $data = $this->AddIfNotNull($data,'email');
            $data = $this->AddIfNotNull($data,'password');

            if(array_key_exists('password',$data))
            {
                $rules = [
                    'password' => ['rules' => 'min_length[8]|max_length[255]'],
                    'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
                ];
                if($this->validate($rules))
                {
                    $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
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

            if(count($data)!=0)
            {
                $model = new UserModel();
                $model->update($this->GetUserId(),$data);
                $res = [
                    'message' => 'Пользователь обновлён.',
                ];

                return $this->respond($res, 200);
            }
            else
            {
                $res = [
                    'message' => 'Нет данных для обновления.',
                ];

                return $this->respond($res, 409);
            }

        }
        catch (\Exception $e)
        {
            $res = [
                'errors'=> $e->getMessage(),
                'line'=> $e->getLine(),
                'message'=>'Ошибка.',
            ];

            return $this->respond($res, 400);
        }
    }
}
