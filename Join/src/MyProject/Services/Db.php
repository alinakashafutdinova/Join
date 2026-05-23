<?php

namespace MyProject\Services;

use MyProject\Exceptions\DbException;

class Db
{
    /** @var \PDO */
    private $pdo;

    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

        try {
            $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'utf8'");
        } catch (\PDOException $e) {
            throw new DbException($e->getMessage());
        }
    }

    /**
     * Выполняет SQL-запрос и возвращает результат в виде массива объектов.
     *
     * @param string $sql       Текст запроса (можно с псевдопеременными)
     * @param array  $params    Значения псевдопеременных
     * @param string $className Класс, объекты которого создавать из строк
     * @return array|null
     */
    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $result = $sth->execute($params);
            if (false === $result) {
                return null;
            }
            return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
        } catch (\PDOException $e) {
            throw new DbException($e->getMessage());
        }
    }
}
