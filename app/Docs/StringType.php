<?php


namespace App\Docs;


class StringType implements Schema
{
    /**
     * @var string
     */
    private $example;

    public function __construct(string $example = 'string')
    {
        $this->example = $example;
    }

    public function render()
    {
        return [
            'type' => 'string',
            'example' => $this->example,
        ];
    }
}
