<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\View\View;

class MainController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main(): void
    {
        // На главной title не передаём — в header.php сработает значение
        // по умолчанию «Мой блог».
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name): void
    {
        // ДЗ4: для страницы /hello/$name задаём собственный title.
        // В шаблоне header.php он подставится в тег <title>.
        $this->view->renderHtml('main/hello.php', [
            'name'  => $name,
            'title' => 'Страница приветствия',
        ]);
    }

    // ДЗ3: новый экшн — выводит «Пока, $name».
    // ДЗ4: тоже передаём собственный title.
    public function sayBye(string $name): void
    {
        $this->view->renderHtml('main/bye.php', [
            'name'  => $name,
            'title' => 'Страница прощания',
        ]);
    }
}
