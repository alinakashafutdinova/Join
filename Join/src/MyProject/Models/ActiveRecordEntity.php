<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
    /** @var int */
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Магический сеттер: PDO при FETCH_CLASS пытается задать свойства
     * с именами столбцов (author_id), а у нас они в camelCase (authorId).
     * Здесь и происходит преобразование.
     */
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $source))));
    }

    /**
     * Возвращает все записи таблицы в виде массива объектов.
     */
    public static function findAll(): array
    {
        $db = new Db();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    /**
     * Возвращает одну запись по id или null, если её нет.
     */
    public static function getById(int $id): ?self
    {
        $db = new Db();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    /**
     * Каждая сущность обязана сообщить имя своей таблицы.
     */
    abstract protected static function getTableName(): string;
}
