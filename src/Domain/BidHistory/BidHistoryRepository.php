<?php


namespace Gazprom\Domain\BidHistory;


/**
 * Interface BidHistoryRepository
 * @package Gazprom\Domain\BidHistory
 */
interface BidHistoryRepository
{
    /**
     * @param array $bids
     * @return bool
     */
    public function addBatch(array $bids): bool;
}