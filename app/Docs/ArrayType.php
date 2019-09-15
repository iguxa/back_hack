<?php


namespace App\Docs;


class ArrayType implements Schema
{
    /**
     * @var Schema
     */
    private $schema;

    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    public function render()
    {
        return [
            "type" => "array",
            "items" => $this->schema->render(),
        ];
    }
}
