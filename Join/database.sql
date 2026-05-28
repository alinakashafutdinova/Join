-- ============================================================
--  База данных для блога
--  Импортируйте этот файл в phpMyAdmin или выполните в консоли MySQL.
-- ============================================================

SET NAMES utf8;

CREATE DATABASE IF NOT EXISTS `blog`
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE `blog`;

-- ----------------------- Пользователи -----------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id`            int(11)      NOT NULL AUTO_INCREMENT,
    `nickname`      varchar(128) NOT NULL,
    `email`         varchar(255) NOT NULL,
    `is_confirmed`  tinyint(1)   NOT NULL DEFAULT 0,
    `role`          enum('admin','user') NOT NULL DEFAULT 'user',
    `password_hash` varchar(255) NOT NULL,
    `auth_token`    varchar(255) NOT NULL,
    `created_at`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `nickname` (`nickname`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`) VALUES
('admin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1'),
('user',  'user@gmail.com',  1, 'user',  'hash2', 'token2');

-- ------------------------- Статьи ---------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `author_id`  int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `text`       text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`author_id`, `name`, `text`) VALUES
(1, 'Статья №1', 'Всем привет, это текст первой статьи. Он может содержать несколько абзацев и подробное описание любой темы.\n\nВторой абзац статьи для демонстрации того, как работает разбиение текста на абзацы при выводе.'),
(1, 'Статья №2', 'Всем привет, это текст второй статьи. Здесь рассказывается о чём-то полезном и интересном.\n\nКаждая статья имеет автора, дату публикации и собственный URL вида /articles/N — это удобно для пользователей и для поисковых систем.');
