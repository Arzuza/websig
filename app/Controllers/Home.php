<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
class PetaController extends BaseController
{
    public function index()
    {
        return view('peta');
    }
}