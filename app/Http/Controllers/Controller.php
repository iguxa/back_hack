<?php

namespace App\Http\Controllers;

use App\Docs\ArrayType;
use App\Docs\BooleanType;
use App\Docs\NumberType;
use App\Docs\ObjectType;
use App\Docs\Response;
use App\Docs\Responses;
use App\Docs\StringType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @param $action
     * @return
     * @throws \Exception
     */
    public static function getDocParameters($action)
    {
        $method = 'getDocParameters'.ucfirst($action);
        if(method_exists(static::class, $method)){
            return static::$method();
        }
        return null;
    }

    /**
     * @param $action
     * @return
     * @throws \Exception
     */
    public static function getDocResponses($action)
    {
        $responsesMethod = 'getDocResponses'.ucfirst($action);
        $exampleMethod = 'getExampleResponseData'.ucfirst($action);
        if(method_exists(static::class, $responsesMethod)){
            return static::$responsesMethod();
        } elseif(method_exists(static::class, $exampleMethod)) {
            return Responses::create()
                ->push(200, new Response(self::makeDocFromExampleResponseData(static::$exampleMethod())));
        }
        return null;
    }

    private static function makeDocFromExampleResponseData($data)
    {
        if(is_array($data) && isset($data[0])){
            return new ArrayType(self::makeDocFromExampleResponseData($data[0]));
        } elseif(is_array($data)) {
            $object = ObjectType::create();
            foreach ($data as $key => $value) {
                $object->push($key, self::makeDocFromExampleResponseData($value));
            }
            return $object;
        } elseif (is_integer($data) || is_float($data)){
            return new NumberType($data);
        } elseif (is_string($data)) {
            return new StringType($data);
        } elseif (is_bool($data)) {
            return new BooleanType($data);
        }
        return null;
    }
}
