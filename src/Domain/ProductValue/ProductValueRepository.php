<?php


namespace Gazprom\Domain\ProductValue;


/**
 * Interface ProductRepository
 * @package Gazprom\Domain\ProductValue
 */
interface ProductValueRepository
{
    /**
     * @param ProductValue $productValue
     * @return bool
     */
    public function add(ProductValue $productValue): bool;

    /**
     * @param ProductValue $productValue
     * @return bool
     */
    public function refresh(ProductValue $productValue): bool;

    /**
     * @param ProductValue $productValue
     * @return bool
     */
    public function delete(ProductValue $productValue): bool;

    /**
     * @param int $id
     * @return ProductValue|null
     */
    public function find(int $id): ?ProductValue;
}