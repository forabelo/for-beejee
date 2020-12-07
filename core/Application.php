<?php


namespace Core;


class Application
{
    public static string $rootPath;
    public static Application $app;

    public Request $request;
    public Response $response;
    public Router $router;

    public function __construct(string $rootPath)
    {
        self::$rootPath = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        $this->router->resolve();
    }
}