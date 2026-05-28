<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Exceptions\NotFoundException;

class ArticlesController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function show(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        // ДЗ5: дополнительный запрос за автором статьи из таблицы users.
        // Получаем объект User по author_id и передаём его в шаблон.
        $author = User::getById($article->getAuthorId());

        // ДЗ4: title страницы — заголовок статьи.
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'author'  => $author,
            'title'   => $article->getName(),
        ]);
    }
}
