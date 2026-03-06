<?php

namespace App\Controllers;

use Exception;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class HomeController
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->responseFactory->view('home.html.twig', [
            'request' => $request
        ]);
    }

    /**
     * @throws Exception
     */
    public function about(Request $request): Response
    {
        return $this->responseFactory->view('about.html.twig', [
            'request' => $request
        ]);
    }
}
