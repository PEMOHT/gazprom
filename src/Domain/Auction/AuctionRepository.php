<?php


namespace Gazprom\Domain\Auction;


/**
 * Interface AuctionRepository
 * @package Gazprom\Domain\Auction
 */
interface AuctionRepository
{
    /**
     * @param Auction $auction
     * @return bool
     */
    public function add(Auction $auction): bool;

    /**
     * @param Auction $auction
     * @return bool
     */
    public function refresh(Auction $auction): bool;

    /**
     * @param int $id
     * @return Auction|null
     */
    public function find(int $id): ?Auction;
}