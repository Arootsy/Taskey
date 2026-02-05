<?php

namespace App\Controller;

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