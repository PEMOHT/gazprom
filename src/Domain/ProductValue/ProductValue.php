<?php

namespace Gazprom\Domain\ProductValue;

use RuntimeException;

/**
 * Class ProductValue
 * @package Gazprom\Domain\ProductValue
 */
class ProductValue
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
     * @var float
     */
    private float $count;
    /**
     * @var int
     */
    private int $type;
    /**
     * @var int
     */
    private int $productId;

    /**
     * ProductValue constructor.
     * @param string $name
     * @param float $count
     * @param int $type
     * @param int $productId
     */
    public function __construct(string $name, float $count, int $type, int $productId)
    {
        $this->checkTypeExist($type);

        $this->name = $name;
        $this->type = $type;
        $this->count = $count;
        $this->productId = $productId;
    }

    /**
     * @param int $type
     */
    private function checkTypeExist(int $type): void
    {
        if (!isset(ProductValueTypes::$types[$type])) {
            throw new RuntimeException("Type doesn't exist", 500);
        }
    }

    /**
     * @param string|null $name
     * @param float|null $count
     * @param int|null $type
     */
    public function update(?string $name, ?float $count, ?int $type): void
    {
        if (!is_null($type)) {
            $this->checkTypeExist($type);
            $this->type = $type;
        }

        if (!is_null($name)) {
            $this->name = $name;
        }

        if (!is_null($count)) {
            $this->count = $count;
        }
    }
}