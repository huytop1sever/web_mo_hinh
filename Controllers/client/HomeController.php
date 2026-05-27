<?php

class HomeController
{
    public function index()
    {
        require_once "Views/Client/Layouts/Header.php";
        require_once "Views/Client/Home/index.php";
        require_once "Views/Client/Layouts/Footer.php";
    }
}