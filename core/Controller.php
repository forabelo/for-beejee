<?php


namespace Core;


class Controller
{
    protected function view(string $view, array $params = [])
    {
        return Application::$app->router->render($view, $params);
    }
}