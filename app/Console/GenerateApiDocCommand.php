<?php

namespace App\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Docs\Parameter;
use Illuminate\Routing\Router;

class GenerateApiDocCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'doc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Asgard CMS';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //$this->blockMessage('Welcome!', 'Starting the installation process...', 'comment');

        $swagger = [
            "swagger" => "2.0",
            "info" => [
                "title" => config('app.doc.title'),
                "version" => config('app.doc.version')
            ],
            "host" => config('app.doc.host'),
            "basePath" => "/",
            "schemes" => [
                "http"
            ],
            "paths" => [],
        ];

        /** @var Router $router */
        $router = app()->router;

        foreach ($router->getRoutes()->getRoutesByName() as $key => $route){
            if(!is_string($route->getAction()['uses'])){
                continue;
            }
            $controllerClass = Str::parseCallback($route->getAction()['uses'])[0];
            if(method_exists($controllerClass, 'getDocResponses')){
                $method = $route->getActionMethod();
                $parameters = [];
                foreach ($route->parameterNames() as $name){
                    $parameters[] = Parameter::string($name)->path()->required();
                }
                foreach ($route->middleware() as $middlewareName){
                    if(isset($router->getMiddleware()[$middlewareName])){
                        $middlewareClass = $router->getMiddleware()[$middlewareName];
                        if(method_exists($middlewareClass, 'getDocParameters') && $middlewareClass::getDocParameters($method)){
                            $parameters = array_merge($parameters, $middlewareClass::getDocParameters($method));
                        }
                    }
                }
                if(method_exists($controllerClass, 'getDocParameters') && $controllerClass::getDocParameters($method)){
                    $parameters = array_merge($parameters, $controllerClass::getDocParameters($method));
                }
                $responses = $controllerClass::getDocResponses($method);
                if($responses){
                    $renderedParameters = [];
                    foreach ($parameters as $parameter) {
                        $renderedParameters[] = $parameter->render();
                    }
                    if(!isset($swagger['paths'][$route->uri()])) {
                        $swagger['paths'][$route->uri()] = [];
                    }
                    $swagger['paths'][$route->uri()][strtolower($route->methods()[0])] = [
                        "parameters"=> $renderedParameters,
                        "responses"=> $responses->render(),
                    ];
                }
            }
        }
        $filename = config('app.doc.file');
        if (file_put_contents($filename, json_encode($swagger)) === false) {
            throw new Exception('Failed to saveAs("' . $filename . '")');
        }

        $this->info('Platform ready! You can now login with your username and password at /backend');
    }
}
