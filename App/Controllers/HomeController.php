<?php

namespace App\Controllers;

use App\Core\AControllerBase;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{

    public function index()
    {
        return $this->html();
    }

    public function qa()
    {
        return $this->html(
            []
        );
    }

    public function aboutus()
    {
        return $this->html(
            []
        );
    }

    public function loggedUser()
    {
        return $this->html(
            []
        );
    }
}