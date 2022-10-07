<?php

namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class TestDB extends Seeder
{
    public function test()
    {
        //$this->db->table("test_table")->insert(["132","Лучезар"]);
        //$dbb = db_connect();
        $data =[];
        $data[1] = ['name'=>'Лучезар'];
        $this->db->table("test_teable")->insert($data);
        //$dbb->table("test_table")->insertBatch($data);
        //$dbb->table("test_table")->insert(["Лучезар"]);
    }
}