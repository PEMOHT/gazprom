<?php


namespace Gazprom\Application\Commands\Product;


/**
 * Class AddProductToAuctionCommand
 * @package Gazprom\Application\Commands\Product
 */
class AddProductToAuctionCommand
{
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var int
     */
    private int $productId;

    /**
     * AddProductToAuctionCommand constructor.
     * @param int $auctionId
     * @param int $productId
     */
    public function __construct(int $auctionId, int $productId)
    {
        $this->auctionId = $auctionId;
        $this->productId = $productId;
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
    public function getProductId(): int
    {
        return $this->productId;
    }
}