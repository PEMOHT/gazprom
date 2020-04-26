<?php


namespace Gazprom\Application\Queries\BidHistory;


use DateTime;

/**
 * Class BidHistory
 * @package Gazprom\Application\Queries\BidHistory
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getAuctionId(): int
    {
        return $this->auctionId;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return DateTime
     */
    public function getBidDate(): DateTime
    {
        return $this->bidDate;
    }
}