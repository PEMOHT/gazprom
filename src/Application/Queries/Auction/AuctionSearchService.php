<?php


namespace Gazprom\Application\Queries\Auction;


/**
 * Interface AuctionSearchService
 * @package Gazprom\Application\Queries\Auction
 */
interface AuctionSearchService
{
    /**
     * TODO тут понятно, видит ли трейдер все аукционы или только свои
     * @param int $userId
     * @return Auction[]
     */
    public function getAllForUser(int $userId): array;

    /**
     * @return Auction[]
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return Auction|null
     */
    public function getAuction(int $id): ?Auction;
}