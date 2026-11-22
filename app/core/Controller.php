<?php
class Controller
{
    protected function view($name, $data = [], $layout = 'layouts/main')
    {
        extract($data, EXTR_SKIP);
        $viewFile = BASE_PATH . "/app/views/$name.php";
        require BASE_PATH . "/app/views/$layout.php";
    }

    protected function redirect($path)
    {
        header('Location: ' . base_url($path), true, 303);
        exit;
    }

    protected function input($key, $default = '')
    {
        $source = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;
        return isset($source[$key]) && is_string($source[$key]) ? trim($source[$key]) : $default;
    }

    protected function flash($type, $msg) { $_SESSION['flash'][$type] = $msg; }
}
