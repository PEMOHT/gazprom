<?php

namespace Gazprom\Application\Commands\ProductValue;

use Gazprom\Domain\ProductValue\ProductValueRepository;
use Gazprom\Domain\ProductValue\ProductValue;

/**
 * Class UpdateProductValueCommandHandler
 * @package Gazprom\Application\Commands\ProductValue
 */
class UpdateProductValueCommandHandler
{
    /**
     * @var ProductValueRepository
     */
    private ProductValueRepository $productValueRepository;

    /**
     * UpdateProductValueCommandHandler constructor.
     * @param ProductValueRepository $productValueRepository
     */
    public function __construct(ProductValueRepository $productValueRepository)
    {
        $this->productValueRepository = $productValueRepository;
    }

    /**
     * @param UpdateProductValueCommand $command
     * @return bool
     */
    public function handle(UpdateProductValueCommand $command): bool
    {
        $productValue = $this->productValueRepository->find($command->getId());

        if (!$productValue instanceof ProductValue) {
            return false;
        }

        $productValue->update($command->getName(), $command->getCount(), $command->getType());

        return $this->productValueRepository->refresh($productValue);
    }
}