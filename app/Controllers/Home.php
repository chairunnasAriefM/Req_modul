<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;

        return view('welcome_message', ['isLoggedIn' => $isLoggedIn]);
    }

    public function tes()
    {
        return view('pages/index.php');
    }
}
