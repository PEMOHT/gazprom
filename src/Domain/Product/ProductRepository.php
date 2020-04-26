<?php


namespace Gazprom\Domain\Product;


/**
 * Interface ProductRepository
 * @package Gazprom\Domain\Product
 */
interface ProductRepository
{
    /**
     * @param Product $product
     * @return bool
     */
    public function add(Product $product): bool;

    /**
     * @param Product $product
     * @return bool
     */
    public function refresh(Product $product): bool;

    /**
     * @param int $id
     * @return Product|null
     */
    public function find(int $id): ?Product;
}