<?php

namespace App\Controller;

class BaseController
{
    public function __construct()
    {
        define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    }
}