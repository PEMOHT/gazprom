<?php


namespace Gazprom\Application\Commands\Auction;


/**
 * Class SetWinnerCommand
 * @package Gazprom\Application\Commands\Auction
 */
class SetWinnerCommand
{
    /**
     * @var int
     */
    private int $auctionId;

    /**
     * SetWinnerCommand constructor.
     * @param int $auctionId
     */
    public function __construct(int $auctionId)
    {
        $this->auctionId = $auctionId;
    }

    /**
     * @return int
     */
    public function getAuctionId(): int
    {
        return $this->auctionId;
    }
}