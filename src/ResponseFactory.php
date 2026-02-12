<?php

namespace Framework;

use Exception;
use PHPStan\BetterReflection\SourceLocator\Exception\EvaledClosureCannotBeLocated;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ResponseFactory
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views');
        $this->twig = new Environment($loader, [
            'debug' => true,
        ]);
    }

    /**
     * @param string $template
     * @param array<string, mixed> $parameters
     * @return Response
     * @throws Exception
     */
    public function view(string $template, array $parameters): Response
    {
        try {
            return new Response(200, $this->twig->render($template, $parameters));
        } catch (Exception $e) {
            throw new Exception('Failed to render page ' . $e);
        }
    }

    public function body(string $txt): Response
    {
        return new Response(200, $txt);
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function notFound(): Response
    {
        try {
            return new Response(404, $this->twig->render('404.twig.html'));
        } catch (Exception $e) {
            throw new Exception('Failed to render page ' . $e);
        }
    }
}
