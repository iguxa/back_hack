<?php


namespace App\Docs;


class ObjectType implements Schema
{
    private $properties = [];

    public static function create()
    {
        return new static();
    }

    public function render()
    {
        $render = [
            "type" => "object",
            "properties" => [],
        ];
        foreach ($this->properties as $key => $property){
            $render["properties"][$key] = $property->render();
        }
        return $render;
    }

    public function push(string $key, Schema $property)
    {
        $this->properties[$key] = $property;
        return $this;
    }
}
