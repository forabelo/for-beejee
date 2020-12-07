<?php


namespace Core;


class Router
{
    public Request $request;
    public Response $response;

    private array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            echo 404;
            die();
        }

        $callback[0] = new $callback[0]();

        call_user_func($callback, $this->request);
    }

    /**
     * @param string $path
     * @param $callback
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param $callback
     */
    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @param string $view
     * @param array $params
     * @return $this
     */
    public function render(string $view, array $params)
    {
        if ($params) {
            foreach ($params as $key => $value) {
                $$key = $value;
            }
        }

        include_once dirname(__DIR__) . "/src/Views/$view.php";

        return $this;
    }
}