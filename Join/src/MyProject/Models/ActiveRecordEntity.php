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
     * Магический сеттер. PDO при FETCH_CLASS обращается по именам столбцов
     * (например, author_id), а у нас они в camelCase (authorId).
     * Здесь приводим snake_case → camelCase.
     */
    public function __set(string $name, $value): void
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $source))));
    }

    /** Получить все записи таблицы. */
    public static function findAll(): array
    {
        $db = new Db();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    /** Получить запись по id или null, если её нет. */
    public static function getById(int $id): ?self
    {
        $db = new Db();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id = :id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    /** Имя таблицы для конкретной сущности. */
    abstract protected static function getTableName(): string;
}
