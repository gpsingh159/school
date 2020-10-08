<?php

namespace controller;

class Engine
{

    public static function load()
    {
        $page = $_GET['page'] ?? 'home';
        if (file_exists("view/$page.php")) {
            @include_once "view/header.php";
            @include_once "view/$page.php";
            @include_once "view/footer.php";
        } else {
            @include_once "view/header.php";
            include_once "view/404.php";
            @include_once "view/footer.php";
        }
    }
}
