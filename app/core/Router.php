<?php
class Router
{
    private static $routes = [];

    public static function get($path, $handler, $middleware = [])  { self::add('GET', $path, $handler, $middleware); }
    public static function post($path, $handler, $middleware = []) { self::add('POST', $path, $handler, $middleware); }

    private static function add($method, $path, $handler, $middleware)
    {
        $regex = '#^' . preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $path) . '$#';
        self::$routes[] = compact('method', 'regex', 'handler', 'middleware');
    }

    public static function dispatch($method, $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
        if ($base !== '' && ($path === $base || strpos($path, $base . '/') === 0)) $path = substr($path, strlen($base));
        $path = '/' . trim($path, '/');

        foreach (self::$routes as $r) {
            if ($r['method'] === $method && preg_match($r['regex'], $path, $m)) {
                if ($method === 'POST') Csrf::verify();
                foreach ($r['middleware'] as $mw) { Auth::$mw(); }   // vd: ['requireAdmin']
                list($class, $action) = explode('@', $r['handler']);
                $params = array_filter($m, 'is_string', ARRAY_FILTER_USE_KEY);
                return call_user_func_array([new $class(), $action], array_values($params));
            }
        }
        http_response_code(404);
        $viewFile = BASE_PATH . '/app/views/errors/404.php';
        $title = 'Không tìm thấy trang';
        $noIndex = true;
        require BASE_PATH . '/app/views/layouts/main.php';
    }
}
