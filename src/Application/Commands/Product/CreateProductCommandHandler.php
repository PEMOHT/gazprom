<?php


namespace Gazprom\Application\Commands\Product;

use Gazprom\Domain\Product\ProductRepository;
use Gazprom\Domain\Product\Product;

/**
 * Class CreateProductCommandHandler
 * @package Gazprom\Application\Commands\Product
 */
class CreateProductCommandHandler
{
    private ProductRepository $productRepository;

    /**
     * CreateProductCommandHandler constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CreateProductCommand $command): bool
    {
        $product = new Product($command->getName(), $command->getUserId());

        return $this->productRepository->add($product);
    }
}