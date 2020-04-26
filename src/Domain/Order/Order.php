<?php


namespace Gazprom\Domain\Order;


/**
 * Class Order
 * @package Gazprom\Domain\Order
 */
class Order
{
    const NEW = 0;
    const ACCEPTED = 1;

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
     * Order constructor.
     * @param int $traderId
     * @param int $buyerId
     * @param int $auctionId
     */
    public function __construct(int $traderId, int $buyerId, int $auctionId)
    {
        $this->traderId = $traderId;
        $this->buyerId = $buyerId;
        $this->auctionId = $auctionId;

        $this->traderState = self::NEW;
        $this->buyerState = self::NEW;
    }

    /**
     *
     */
    public function traderAccept(): void
    {
        $this->traderState = self::ACCEPTED;
    }

    /**
     *
     */
    public function buyerAccept(): void
    {
        $this->buyerState = self::ACCEPTED;
    }
}