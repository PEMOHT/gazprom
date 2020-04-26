<?php


namespace Gazprom\Application\Queries\Order;


/**
 * Class Order
 * @package Gazprom\Application\Queries\Order
 */
class Order
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
    private int $traderId;
    /**
     * @var int
     */
    private int $buyerId;

    /**
     * @var int
     */
    private int $traderState;
    /**
     * @var int
     */
    private int $buyerState;

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
    public function getAuctionId(): int
    {
        return $this->auctionId;
    }

    /**
     * @return int
     */
    public function getTraderId(): int
    {
        return $this->traderId;
    }

    /**
     * @return int
     */
    public function getBuyerId(): int
    {
        return $this->buyerId;
    }

    /**
     * @return int
     */
    public function getTraderState(): int
    {
        return $this->traderState;
    }

    /**
     * @return int
     */
    public function getBuyerState(): int
    {
        return $this->buyerState;
    }
}