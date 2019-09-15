<?php


namespace App\Docs;


class Parameter
{
    const IN_HEADER = 'header';
    const IN_QUERY = 'query';
    const IN_PATH = 'path';
    const IN_BODY = 'body';
    const IN_FORM_DATA = 'formData';

    const STRING = 'string';
    const NUMBER = 'number';
    const INTEGER = 'integer';
    const BOOLEAN = 'boolean';
    const ARRAY = 'array';
    const OBJECT = 'object';

    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $in;
    /**
     * @var bool
     */
    private $required;
    /**
     * @var Schema
     */
    private $schema;
    /**
     * @var array
     */
    private $enum;

    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;
        $this->in = self::IN_QUERY;
        $this->required = false;
    }

    public static function string(string $name)
    {
        return new static(self::STRING, $name);
    }

    public static function number(string $name)
    {
        return new static(self::NUMBER, $name);
    }

    public static function integer(string $name)
    {
        return new static(self::INTEGER, $name);
    }

    public static function boolean(string $name)
    {
        return new static(self::BOOLEAN, $name);
    }

    public static function array(string $name)
    {
        return new static(self::ARRAY, $name);
    }

    public static function object(string $name)
    {
        return new static(self::OBJECT, $name);
    }

    public function header()
    {
        $this->in = self::IN_HEADER;
        return $this;
    }

    public function query()
    {
        $this->in = self::IN_QUERY;
        return $this;
    }

    public function path()
    {
        $this->in = self::IN_PATH;
        return $this;
    }

    public function body()
    {
        $this->in = self::IN_BODY;
        return $this;
    }

    public function formData()
    {
        $this->in = self::IN_FORM_DATA;
        return $this;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function schema(Schema $schema)
    {
        $this->schema = $schema;
        return $this;
    }

    public function enum(array $enum)
    {
        $this->enum = array_values($enum);
        return $this;
    }

    public function render()
    {
        $render = [
            'type' => $this->type,
            'name' => $this->name,
            'in' => $this->in,
            'required' => $this->required,
        ];
        if($this->type===self::ARRAY){
            $render['items'] = $this->schema->render();
        }
        if($this->type===self::OBJECT){
            $render['schema'] = $this->schema->render();
        }
        if($this->enum){
            $render['enum'] = $this->enum;
        }
        return $render;
    }
}
