<?php

namespace App\Controllers;

use App\Repositories\ProjectRepositoryInterface;
use App\Repositories\TaskRepositoryInterface;
use Exception;
use App\Model\Task;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class TaskController
{
    private ResponseFactory $responseFactory;

    private TaskRepositoryInterface $taskRepository;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ResponseFactory $responseFactory, TaskRepositoryInterface $taskRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->responseFactory = $responseFactory;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        $tasks = $this->taskRepository->all();
        return $this->responseFactory->view('tasks/index.html.twig', [
            'tasks' => $tasks,
            'request' => $request
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request): Response
    {
        $task = $this->taskRepository->find((int)$request->get('id'));

        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->priority = (int)$request->get('priority');
        $task->status = (int)$request->get('status');
        $task->progress = (int)$request->get('progress');
        $task->project_id = (int)$request->get('project_id');

        if (!isset($task)) {

        }

        $this->taskRepository->update($task);

        return $this->responseFactory->redirect('/tasks/'.$request->get('id'));
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
            'task' => $task,
            'request' => $request
        ]);
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): Response
    {
        $task = new Task(
            null,
            $request->get('title'),
            $request->get('description'),
            (int)$request->get('priority') ?? 0,
            (int)$request->get('status') ?? 0,
            $request->get('progress') ?? '20',
            $request->get('created_at') ?? time(),
            $request->get('completed_at'),
            (int)$request->get('project_id')
        );

        $task = $this->taskRepository->insert($task);

        if (!isset($task)) {
            $this->responseFactory->internalServerError();
        }

        return $this->responseFactory->redirect('/tasks/'.$task->id);
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): Response
    {
        $isAffected = $this->taskRepository->delete($this->taskRepository->find((int)$request->get('id')));

        if (!$isAffected) {
            $this->responseFactory->internalServerError();
        }

        return $this->responseFactory->redirect('/tasks');
    }
}
