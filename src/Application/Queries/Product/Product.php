<?php


namespace Gazprom\Application\Queries\Product;


class Product
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var int|null
     */
    private ?int $attachedTo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getAttachedTo(): int
    {
        return $this->attachedTo;
    }
}