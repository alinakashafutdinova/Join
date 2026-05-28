<?php

try {
    // Автозагрузчик классов: имя класса с пространством имён
    // превращается в путь к файлу внутри папки src.
    spl_autoload_register(function (string $className) {
        $className = str_replace('\\', '/', $className);
        require_once __DIR__ . '/src/' . $className . '.php';
    });

    // Текущий маршрут берём из параметра route (его формирует .htaccess).
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/src/routes.php';

    // Ищем подходящий роут перебором регулярных выражений.
    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }

    // $matches[0] — вся строка целиком, она нам не нужна.
    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName     = $controllerAndAction[1];

    // Создаём контроллер и вызываем нужный экшн,
    // передавая в него захваченные группы регулярки как аргументы.
    $controller = new $controllerName();
    $controller->$actionName(...$matches);

} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates');
    $view->renderHtml('errors/404.php', [], 404);
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates');
    $view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
}
