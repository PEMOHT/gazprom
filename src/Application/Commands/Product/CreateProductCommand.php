<?php


namespace Gazprom\Application\Commands\Product;


/**
 * Class CreateProductCommand
 * @package Gazprom\Application\Commands\Product
 */
class CreateProductCommand
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var int
     */
    private int $userId;

    /**
     * CreateProductCommand constructor.
     * @param string $name
     * @param int $userId
     */
    public function __construct(string $name, int $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
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


}