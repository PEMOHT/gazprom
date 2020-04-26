<?php


namespace Gazprom\Application\Commands\Product;

use Gazprom\Domain\Product\ProductRepository;
use Gazprom\Domain\Product\Product;

/**
 * Class RemoveProductFromAuctionCommandHandler
 * @package Gazprom\Application\Commands\Product
 */
class RemoveProductFromAuctionCommandHandler
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * RemoveProductFromAuctionCommandHandler constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param RemoveProductFromAuctionCommand $command
     * @return bool
     */
    public function handle(RemoveProductFromAuctionCommand $command): bool
    {
        $product = $this->productRepository->find($command->getProductId());

        if (!$product instanceof Product) {
            return false;
        }

        $product->detach();

        $this->productRepository->refresh($product);

        return true;
    }
}