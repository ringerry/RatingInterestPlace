<?php

namespace App\Controllers;

class Home extends BaseControllerAbstract
{
    public function index()
    {
        return view('welcome_message');
    }
}
