<?php


namespace Gazprom\Domain\BidHistory;


use DateTime;

/**
 * Class BidHistory
 * @package Gazprom\Domain\BidHistory
 */
class BidHistory
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var float
     */
    private float $value;
    /**
     * @var DateTime
     */
    private DateTime $bidDate;

    /**
     * BidHistory constructor.
     * @param int $userId
     * @param int $auctionId
     * @param float $value
     * @param DateTime $bidDate
     */
    public function __construct(int $userId, int $auctionId, float $value, DateTime $bidDate)
    {
        $this->userId = $userId;
        $this->auctionId = $auctionId;
        $this->value = $value;
        $this->bidDate = $bidDate;
    }
}