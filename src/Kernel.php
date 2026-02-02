<?php

namespace Framework;

class Kernel
{
    public function __construct()
    {
    }

    public function handleRequest(Request $request): Response
    {
        return new Response(200, 'beep', 'beep');
    }
}
