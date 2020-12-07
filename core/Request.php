<?php


namespace Core;


class Request
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }

        $path = substr($path, 0, $position);
        return $path;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        $body = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = htmlspecialchars(filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        if ($this->getMethod() === 'post') {

            if ($this->wantsJson()) {
                $_POST = json_decode(file_get_contents('php://input'), true);
                foreach ($_POST as $key => $item) {
                    $body[$key] = $item;
                }
                return $body;
            }
            foreach ($_POST as $key => $value) {
                $body[$key] = htmlspecialchars(filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }
        return $body;
    }

    public function isAuthenticated(): bool
    {
        if (isset($_SESSION["user"])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function wantsJson()
    {
        return json_decode(file_get_contents('php://input', true)) != NULL;
    }
}