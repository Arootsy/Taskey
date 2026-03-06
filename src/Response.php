<?php

namespace Framework;

class Response
{
    public int $responseCode = 200;

    public string $body;

    public ?string $header;

    public function __construct(int $responseCode = 200, string $body = "", ?string $header = null)
    {
        $this->responseCode = $responseCode;
        $this->body = $body;
        $this->header = $header;
    }

    /**
     * Send the response to the client.
     */
    public function echo(): void
    {
        if ($this->header !== null) {
            header($this->header);
        }
        http_response_code($this->responseCode);
        echo $this->body;
    }
}
