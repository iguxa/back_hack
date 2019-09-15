<?php


namespace App\Docs;


class Responses
{
    private $responses = [];

    public static function create()
    {
        return new static();
    }

    public function push(string $status, Response $response)
    {
        $this->responses[$status] = $response;
        return $this;
    }

    public function render()
    {
        $render = [];
        foreach ($this->responses as $status => $response){
            $render[$status] = $response->render();
        }
        return $render;
    }
}
