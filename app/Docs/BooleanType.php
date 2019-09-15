<?php


namespace App\Docs;


class BooleanType implements Schema
{
    /**
     * @var bool
     */
    private $example;

    public function __construct(bool $example)
    {
        $this->example = $example;
    }

    public function render()
    {
        return [
            'type' => 'boolean',
            'example' => $this->example,
        ];
    }
}
