<?php

namespace Gazprom\Application\Commands\ProductValue;

use Gazprom\Domain\ProductValue\ProductValueRepository;
use Gazprom\Domain\ProductValue\ProductValue;

/**
 * Class AddProductValueCommandHandler
 * @package Gazprom\Application\Commands\ProductValue
 */
class AddProductValueCommandHandler
{
    private ProductValueRepository $productValueRepository;

    /**
     * AddProductValueCommandHandler constructor.
     * @param ProductValueRepository $productValueRepository
     */
    public function __construct(ProductValueRepository $productValueRepository)
    {
        $this->productValueRepository = $productValueRepository;
    }

    public function handle(AddProductValueCommand $command): bool
    {
        $productValue = new ProductValue(
            $command->getName(),
            $command->getCount(),
            $command->getType(),
            $command->getProductId()
        );

        return $this->productValueRepository->add($productValue);
    }
}