<?php

namespace App\Controllers;

use App\Repositories\ProjectRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class ProjectController
{
    private ResponseFactory $responseFactory;

    private ProjectRepositoryInterface $projectRepository;

    public function __construct(ResponseFactory $responseFactory, ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->responseFactory = $responseFactory;
    }

    public function index(Request $request): Response
    {
        $projects = $this->projectRepository->all();
        return $this->responseFactory->view('projects/index.html.twig', [
            "projects" => $projects
        ]);
    }
}