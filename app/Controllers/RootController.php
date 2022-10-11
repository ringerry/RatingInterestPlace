<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class RootController extends BaseController
{
    use ResponseTrait;

    protected function AddIfNotNull($data, $field)
    {
        if(!is_null($this->request->getVar($field)))
        {
            $data[$field] = $this->request->getVar($field);
        }

        return $data;
    }

    public function index()
    {
        //
    }
}
