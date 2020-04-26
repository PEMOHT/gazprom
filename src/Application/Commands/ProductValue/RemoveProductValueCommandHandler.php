<?php

namespace Gazprom\Application\Commands\ProductValue;

use Gazprom\Domain\ProductValue\ProductValueRepository;
use Gazprom\Domain\ProductValue\ProductValue;

/**
 * Class RemoveProductValueCommandHandler
 * @package Gazprom\Application\Commands\ProductValue
 */
class RemoveProductValueCommandHandler
{
    /**
     * @var ProductValueRepository
     */
    private ProductValueRepository $productValueRepository;

    /**
     * RemoveProductValueCommandHandler constructor.
     * @param ProductValueRepository $productValueRepository
     */
    public function __construct(ProductValueRepository $productValueRepository)
    {
        $this->productValueRepository = $productValueRepository;
    }

    /**
     * @param RemoveProductValueCommand $command
     * @return bool
     */
    public function handle(RemoveProductValueCommand $command): bool
    {
        $productValue = $this->productValueRepository->find($command->getId());

        if (!$productValue instanceof ProductValue) {
            return false;
        }

        return $this->productValueRepository->delete($productValue);
    }
}