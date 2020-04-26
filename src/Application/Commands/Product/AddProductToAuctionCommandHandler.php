<?php


namespace Gazprom\Application\Commands\Product;

use Gazprom\Domain\Product\ProductRepository;
use Gazprom\Domain\Product\Product;

/**
 * Class AddProductToAuctionCommandHandler
 * @package Gazprom\Application\Commands\Product
 */
class AddProductToAuctionCommandHandler
{
    private ProductRepository $productRepository;

    /**
     * AddProductToAuctionCommandHandler constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(AddProductToAuctionCommand $command): bool
    {
        $product = $this->productRepository->find($command->getProductId());

        if (!$product instanceof Product) {
            return false;
        }

        if (!$product->attach($command->getAuctionId())) {
            return false;
        }

        $this->productRepository->refresh($product);

        return true;
    }
}