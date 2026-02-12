<?php

namespace App\Controllers;

use Exception;
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
        return $this->responseFactory->view('tasks/index.html.twig', [
            'navigation' => [
                array('caption' => 'Joo', 'href' => 'about'),
                array('caption' => 'Taskkkv', 'href' => 'task'),
            ]
        ]);
    }
}
