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
        // title не передаём — в шаблоне сработает значение по умолчанию "Мой блог"
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name): void
    {
        // ДЗ4: для страницы /hello/$name задаём свой title
        $this->view->renderHtml('main/hello.php', [
            'name'  => $name,
            'title' => 'Страница приветствия',
        ]);
    }

    public function sayBye(string $name): void
    {
        echo 'Пока, ' . $name;
    }
}
