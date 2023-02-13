<?php
namespace App\Http;

class Response{

    private int $httpCode = 200;
    private array $headers = [];

    private string $contentType = 'text/html';
    private $content;

    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader($key, $value){
        $this->headers[$key] = $value;
    }

    public function ad(){
        return 'ola';
    }
}