<?php


namespace Gazprom\Application\Commands\AuctionRequest;


/**
 * Class CreateAuctionRequestCommand
 * @package Gazprom\Application\Commands\AuctionRequest
 */
class CreateAuctionRequestCommand
{
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var int
     */
    private int $auctionId;

    /**
     * CreateAuctionRequestCommand constructor.
     * @param int $userId
     * @param int $auctionId
     */
    public function __construct(int $userId, int $auctionId)
    {
        $this->userId = $userId;
        $this->auctionId = $auctionId;
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
}