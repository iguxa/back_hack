<?php


namespace App\Docs;


class NumberType implements Schema
{
    /**
     * @var string
     */
    private $example;

    public function __construct(int $example = 0)
    {
        $this->example = $example;
    }

    public function render()
    {
        return [
            'type' => 'number',
            'example' => $this->example,
        ];
    }
}
