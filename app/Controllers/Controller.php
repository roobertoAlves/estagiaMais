<?php

namespace App\Controllers;

class Controller
{
    protected function render(string $viewName, array $data = []): string
    {
        $viewPath = RESOURCES_PATH . '/views/' . $viewName . '.php';
        if (!is_file($viewPath)) {
            http_response_code(500);
            exit('View não encontrada.');
        }

        extract($data, EXTR_SKIP);
        ob_start();
        require $viewPath;
        return (string) ob_get_clean();
    }
}
