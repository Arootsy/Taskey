<?php

namespace App\Controllers;

use App\Repositories\TaskRepositoryInterface;
use Exception;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class TaskController
{
    private ResponseFactory $responseFactory;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        $tasks = $this->taskRepository->all();
        return $this->responseFactory->view('tasks/index.html.twig', [
            "tasks" => $tasks
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function show(Request $request): Response
    {
        $task = $this->taskRepository->find((int)$request->get('id'));

        if (!isset($task)) {
            return $this->responseFactory->notFound();
        }

        return $this->responseFactory->view('tasks/show.html.twig', [
            "task" => $task
        ]);
    }
}
