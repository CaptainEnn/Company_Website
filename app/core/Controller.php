<?php
class Controller
{
    protected function view($name, $data = [], $layout = 'layouts/main')
    {
        extract($data);
        $viewFile = BASE_PATH . "/app/views/$name.php";
        require BASE_PATH . "/app/views/$layout.php";
    }

    protected function redirect($path)
    {
        header('Location: ' . base_url($path));
        exit;
    }

    protected function input($key, $default = '')
    {
        return isset($_POST[$key]) ? trim($_POST[$key]) : (isset($_GET[$key]) ? trim($_GET[$key]) : $default);
    }

    protected function flash($type, $msg) { $_SESSION['flash'][$type] = $msg; }
}
