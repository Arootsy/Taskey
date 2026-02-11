<?php

namespace Framework;

class ResponseFactory
{
    public function body(string $txt): Response
    {
        return new Response(200, $txt);
    }

    public function notFound(): Response
    {
        return new Response(200, 'PAGINA NIET GEVONDEN');
    }
}
