<?php


namespace Gazprom\Application\Commands\Product;


/**
 * Class RemoveProductFromAuctionCommand
 * @package Gazprom\Application\Commands\Product
 */
class RemoveProductFromAuctionCommand
{
    /**
     * @var int
     */
    private int $productId;

    /**
     * RemoveProductFromAuctionCommand constructor.
     * @param int $productId
     */
    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}