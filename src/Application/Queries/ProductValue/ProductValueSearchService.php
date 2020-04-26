<?php


namespace Gazprom\Application\Queries\ProductValue;


/**
 * Interface ProductSearchService
 * @package Gazprom\Application\Queries\ProductValue
 */
interface ProductValueSearchService
{
    /**
     * @param int $productId
     * @return ProductValue[]
     */
    public function geValuesOfProduct(int $productId): array;

    /**
     * @param int $userId
     * @return ProductValue[]
     */
    public function getAllProductsForUser(int $userId): array;

    /**
     * @param int $id
     * @return ProductValue|null
     */
    public function getProduct(int $id): ?ProductValue;


}