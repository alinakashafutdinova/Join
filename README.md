# ДЗ №5 — Автор статьи (ORM)

Блог на самописном MVC-фреймворке (по лекции к теме 3). Включает всё из ДЗ3 и ДЗ4 плюс задание ДЗ5.

## Что сделано по заданию

В экшне `ArticlesController::show()` после получения статьи добавлен ещё один запрос — на получение автора этой статьи из таблицы `users`. Никнейм автора выводится в шаблоне.

Как это работает:
- В контроллере `src/MyProject/Controllers/ArticlesController.php`:
  ```php
  $article = Article::getById($articleId);
  // ...
  $author = User::getById($article->getAuthorId());   // запрос в таблицу users
  $this->view->renderHtml('articles/view.php', [
      'article' => $article,
      'author'  => $author,
  ]);
  ```
  Используется ORM-метод `getById()` из `ActiveRecordEntity`, который под капотом делает
  `SELECT * FROM users WHERE id = :id`.
- В шаблоне `templates/articles/view.php` выводится никнейм:
  ```php
  <p><strong>Автор:</strong> <?= htmlspecialchars($author->getNickname()) ?></p>
  ```
- Связь: у статьи поле `author_id` (геттер `getAuthorId()`), у пользователя — `nickname` (геттер `getNickname()`).

## Как запустить

**XAMPP / OpenServer / хостинг:** импортировать `database.sql` (в таблице `users` уже есть пользователи `admin` и `user`, статьи привязаны к `admin`), проверить `src/settings.php`, указать корнем папку `www`.

**Встроенный сервер PHP:**
```bash
php -S localhost:8000 -t www www/router.php
```

## Адреса для проверки
- `/articles/1` — на странице статьи строка **«Автор: admin»** ← задание ДЗ5
- `/articles/2` — то же, автор «admin»
- `/hello/Имя` — title «Страница приветствия» (из ДЗ4)
- `/bye/Имя` — «Пока, Имя» (из ДЗ3)
