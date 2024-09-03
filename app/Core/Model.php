<?php

namespace App\Core;

use App\Utils\DB;

class Model
{
    protected $model;

    public function __construct()
    {
        $this->model = DB::getInstance();
    }
}