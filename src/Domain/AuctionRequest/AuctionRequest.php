<?php


namespace Gazprom\Domain\AuctionRequest;


/**
 * Class AuctionRequest
 * @package Gazprom\Domain\AuctionRequest
 */
class AuctionRequest
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var int
     */
    private int $userId;

    /**
     * AuctionRequest constructor.
     * @param int $auctionId
     * @param int $userId
     */
    public function __construct(int $auctionId, int $userId)
    {
        $this->auctionId = $auctionId;
        $this->userId = $userId;
    }
}