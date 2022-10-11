<?php

namespace App\Controllers;



use App\Models\TestModel;

class BasicController extends BaseControllerAbstract
{
    public function index()
    {
        $TestModel = new TestModel();
        $data =[];
        $data[0] = ['name'=>'Лучезар'];
        //$getedData = $TestModel->findAll();
        d($data);
        //$tst = $data[0]['name'];

        $db = db_connect();
        $dataa = $db->table("test_table")->insertBatch($data);

        return '';
    }
}
