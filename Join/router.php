<?php
// Этот файл используется только встроенным сервером PHP.
// Если запрошен реально существующий файл (CSS, картинка) — отдаём его,
// иначе — направляем запрос на фронт-контроллер index.php.

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// urldecode нужен, чтобы кириллица в URL (/hello/Иван) декодировалась
// в обычные символы. На Apache это делает сам PHP при разборе $_GET.
$_GET['route'] = urldecode(ltrim($uri, '/'));
require __DIR__ . '/index.php';
