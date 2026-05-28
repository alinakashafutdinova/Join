<?php

namespace MyProject\Services;

use MyProject\Exceptions\DbException;

class Db
{
    /** @var \PDO */
    private $pdo;

    public function __construct()
    {
        $settings = require __DIR__ . '/../../settings.php';

        try {
            $dsn = 'mysql:host=' . $settings['db']['host'] .
                ';dbname=' . $settings['db']['dbname'] .
                ';charset=utf8';

            $this->pdo = new \PDO(
                $dsn,
                $settings['db']['user'],
                $settings['db']['password']
            );
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $this->pdo->exec('SET NAMES utf8');
        } catch (\PDOException $e) {
            throw new DbException('Ошибка подключения: ' . $e->getMessage());
        }
    }

    /**
     * Выполнить SQL-запрос с параметрами.
     * Если задан $className — результат раскладывается в объекты этого класса
     * (PDO::FETCH_CLASS).
     */
    public function query(string $sql, array $params = [], ?string $className = null)
    {
        $sth = $this->pdo->prepare($sql);

        try {
            $result = $sth->execute($params);
        } catch (\PDOException $e) {
            throw new DbException('Ошибка выполнения запроса: ' . $e->getMessage());
        }

        if ($result === false) {
            return false;
        }

        if ($className === null) {
            return $sth->fetchAll();
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}
