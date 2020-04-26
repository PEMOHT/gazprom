<?php


namespace Gazprom\Application\Commands\BidHistory;


/**
 * Class CreateBidsHistoryCommand
 * @package Gazprom\Application\Commands\BidHistory
 */
class CreateBidsHistoryCommand
{
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var array
     */
    private array $bids;

    /**
     * CreateBidsHistoryCommand constructor.
     * @param array $bids
     * @param int $auctionId
     */
    public function __construct(array $bids, int $auctionId)
    {
        $this->bids = $bids;
        $this->auctionId = $auctionId;
    }

    /**
     * @return array
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    /**
     * @return int
     */
    public function getAuctionId(): int
    {
        return $this->auctionId;
    }
}