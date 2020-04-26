<?php


namespace Gazprom\Application\Commands\Order;


/**
 * Class CreateOrderCommand
 * @package Gazprom\Application\Commands\Order
 */
class CreateOrderCommand
{
    /**
     * @var int
     */
    private int $auctionId;

    /**
     * CreateOrderCommand constructor.
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