<?php
/** @var string|null $title */
$route = $_GET['route'] ?? '';
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Мой блог' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Source+Serif+Pro:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/styles.css">
</head>
<body>

<header class="site-header">
    <div class="container">
        <a href="/" class="brand"><span class="dot"></span> Мой блог</a>
        <nav class="nav">
            <a href="/">Главная</a>
            <a href="/articles/1">Статья 1</a>
            <a href="/articles/2">Статья 2</a>
            <a href="/hello/Гость">Привет</a>
        </nav>
    </div>
</header>

<main>
    <div class="container">
