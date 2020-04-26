<?php


namespace Gazprom\Application\Commands\Product;

use Gazprom\Domain\Product\ProductRepository;
use Gazprom\Domain\Product\Product;

/**
 * Class RenameProductCommandHandler
 * @package Gazprom\Application\Commands\Product
 */
class RenameProductCommandHandler
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * RenameProductCommandHandler constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param RenameProductCommand $command
     * @return bool
     */
    public function handle(RenameProductCommand $command): bool
    {
        $product = $this->productRepository->find($command->getProductId());

        if (!$product instanceof Product) {
            return false;
        }

        $product->rename($command->getName());

        $this->productRepository->refresh($product);

        return true;
    }
}