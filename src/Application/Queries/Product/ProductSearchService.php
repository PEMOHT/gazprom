<?php


namespace Gazprom\Application\Queries\Product;


/**
 * Interface ProductSearchService
 * @package Gazprom\Application\Queries\Product
 */
interface ProductSearchService
{
    /**
     * @param int $auctionId
     * @return Product[]
     */
    public function getAllProductsForAuction(int $auctionId): array;

    /**
     * @param int $userId
     * @return Product[]
     */
    public function getAllProductsForUser(int $userId): array;

    /**
     * @param int $id
     * @return Product|null
     */
    public function getProduct(int $id): ?Product;


}