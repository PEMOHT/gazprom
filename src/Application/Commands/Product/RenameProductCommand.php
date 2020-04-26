<?php


namespace Gazprom\Application\Commands\Product;


/**
 * Class RenameProductCommand
 * @package Gazprom\Application\Commands\Product
 */
class RenameProductCommand
{
    /**
     * @var int
     */
    private int $productId;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
    /**
     * @var string
     */
    private string $name;

    /**
     * RenameProductCommand constructor.
     * @param int $productId
     * @param string $name
     */
    public function __construct(int $productId, string $name)
    {
        $this->name = $name;
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}