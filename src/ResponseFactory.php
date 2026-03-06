<?php

namespace Framework;

use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class ResponseFactory
{
    private Environment $twig;

    public function __construct(bool $debug, string $path)
    {
        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader, [
            'debug' => $debug,
        ]);
    }

    /**
     * @param string $template
     * @param array<string, mixed> $parameters
     * @return Response
     * @throws Exception
     */
    public function view(string $template, array $parameters = []): Response
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
            return new Response(404, $this->twig->render('404.html.twig'));
        } catch (Exception $e) {
            throw new Exception('Failed to render page ' . $e);
        }
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function internalServerError(): Response
    {
        try {
            return new Response(500, $this->twig->render('500.html.twig'));
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * @throws Exception
     * */
    public function redirect(string $url): Response
    {
        return new Response(302, '', 'Location: ' . $url);
    }
}
