-- ============================================================
--  База данных для блога (тема 3)
--  Импортируйте этот файл в phpMyAdmin или выполните в консоли MySQL.
-- ============================================================

-- Гарантируем корректную кодировку при импорте
SET NAMES utf8;

CREATE DATABASE IF NOT EXISTS `blog`
    DEFAULT CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE `blog`;

-- ----------------------- Пользователи -----------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id`            int(11)      NOT NULL,
    `nickname`      varchar(128) NOT NULL,
    `email`         varchar(255) NOT NULL,
    `is_confirmed`  tinyint(1)   NOT NULL DEFAULT '0',
    `role`          enum('admin','user') NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `auth_token`    varchar(255) NOT NULL,
    `created_at`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nickname` (`nickname`),
    ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(NULL, 'admin', 'admin@gmail.com', '1', 'admin', 'hash1', 'token1', CURRENT_TIMESTAMP),
(NULL, 'user',  'user@gmail.com',  '1', 'user',  'hash2', 'token2', CURRENT_TIMESTAMP);

-- ------------------------- Статьи ---------------------------
CREATE TABLE IF NOT EXISTS `articles` (
    `id`         int(11)      NOT NULL,
    `author_id`  int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `text`       text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `articles`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `articles`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`) VALUES
(NULL, '1', 'Статья №1', 'Всем привет, это текст первой статьи. Можно взять что-то вроде Lorem Ipsum.', CURRENT_TIMESTAMP),
(NULL, '1', 'Статья №2', 'Всем привет, это текст второй статьи. Можно взять что-то вроде Lorem Ipsum.', CURRENT_TIMESTAMP);
