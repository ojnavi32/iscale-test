<?php

namespace App\Controller;

use App\Utils\NewsManager;

class HomeController extends BaseController
{
    public function index()
    {
        $data = (new NewsManager())->newsWithComments();

        require_once(ROOT . 'app/View/index.php');
    }
}
