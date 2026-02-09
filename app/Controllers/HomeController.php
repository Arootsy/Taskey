<?php

namespace App\Controllers;

use Framework\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response(200, 'Dit is Home/index');
    }

    public function about(): Response
    {
        return new Response(200, "Dit is Home/about");
    }
}
