<?php

namespace Gazprom\Application\Queries\BidHistory;

/**
 * Interface ProductSearchService
 * @package Gazprom\Application\Queries\AuctionDocument
 */
interface BidHistorySearchService
{
    /**
     * @param int $auctionId
     * @return BidHistory[]
     */
    public function getBidsForAuction(int $auctionId): array;
}