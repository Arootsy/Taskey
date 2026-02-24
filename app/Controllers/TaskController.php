<?php

namespace App\Controllers;

use Exception;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class TaskController
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        return $this->responseFactory->view('tasks/index.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function show(Request $request): Response
    {
        return $this->responseFactory->view('tasks/show.html.twig', [
            "id" => $request->get('id')
        ]);
    }
}
