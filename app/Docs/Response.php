<?php


namespace App\Docs;


class Response
{
    /**
     * @var Schema
     */
    private $schema;
    /**
     * @var string
     */
    private $description;

    public function __construct(Schema $schema, $description = '')
    {
        $this->schema = $schema;
        $this->description = $description;
    }

    public function render()
    {
        return [
            "description" => $this->description,
            "schema" => $this->schema->render(),
        ];
    }
}
