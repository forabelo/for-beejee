<?php


namespace Core;


class Response
{

    /**
     * @param array $data
     * @param int $statusCode
     * @return bool
     */
    public static function json(array $data, int $statusCode = 200): bool
    {
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($data);
        return true;
    }

    public function redirect(string $url)
    {
        header("Location: $url");
    }
}