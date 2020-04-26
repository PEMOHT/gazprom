<?php


namespace Gazprom\Domain\AuctionRequest;


/**
 * Interface AuctionRequestRepository
 * @package Gazprom\Domain\AuctionRequest
 */
interface AuctionRequestRepository
{
    /**
     * @param AuctionRequest $auctionRequest
     * @return bool
     */
    public function add(AuctionRequest $auctionRequest): bool;

    /**
     * @param AuctionRequest $auctionRequest
     * @return bool
     */
    public function remove(AuctionRequest $auctionRequest): bool;
}