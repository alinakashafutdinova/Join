<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    /** @var int */
    protected $authorId;

    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthorId(): int
    {
        return (int) $this->authorId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /** Короткий анонс для списка статей. */
    public function getExcerpt(int $length = 180): string
    {
        $text = trim($this->text);
        if (mb_strlen($text) <= $length) {
            return $text;
        }
        return mb_substr($text, 0, $length) . '…';
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }
}
