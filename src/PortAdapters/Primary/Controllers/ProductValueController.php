<?php

namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Domain\User\UserPermission;
use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Product\ProductSearchService;
use Gazprom\Application\Queries\Product\Product;
use Gazprom\Application\Queries\ProductValue\ProductValueSearchService;
use Gazprom\Application\Commands\ProductValue\AddProductValueCommandHandler;
use Gazprom\Application\Commands\ProductValue\AddProductValueCommand;
use Gazprom\Application\Commands\ProductValue\UpdateProductValueCommand;
use Gazprom\Application\Commands\ProductValue\UpdateProductValueCommandHandler;
use Gazprom\Application\Commands\ProductValue\RemoveProductValueCommand;
use Gazprom\Application\Commands\ProductValue\RemoveProductValueCommandHandler;

/**
 * Class ProductValueController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class ProductValueController extends AbstractController
{
    /**
     * @var ProductSearchService
     */
    private ProductSearchService $productSearchService;
    /**
     * @var ProductValueSearchService
     */
    private ProductValueSearchService $productValueSearchService;
    /**
     * @var AddProductValueCommandHandler
     */
    private AddProductValueCommandHandler $addProductValueCommandHandler;
    /**
     * @var UpdateProductValueCommandHandler
     */
    private UpdateProductValueCommandHandler $updateProductValueCommandHandler;
    /**
     * @var RemoveProductValueCommandHandler
     */
    private RemoveProductValueCommandHandler $removeProductValueCommandHandler;


    /**
     * ProductValueController constructor.
     * @param UserSearchService $userSearchService
     * @param ProductSearchService $auctionSearchService
     * @param ProductValueSearchService $productValueSearchService
     * @param AddProductValueCommandHandler $addProductValueCommandHandler
     * @param UpdateProductValueCommandHandler $updateProductValueCommandHandler
     * @param RemoveProductValueCommandHandler $removeProductValueCommandHandler
     */
    public function __construct(
        UserSearchService $userSearchService,

        ProductSearchService $auctionSearchService,
        ProductValueSearchService $productValueSearchService,
        AddProductValueCommandHandler $addProductValueCommandHandler,
        UpdateProductValueCommandHandler $updateProductValueCommandHandler,
        RemoveProductValueCommandHandler $removeProductValueCommandHandler
    )
    {
        parent::__construct($userSearchService);

        $this->productSearchService = $auctionSearchService;
        $this->productValueSearchService = $productValueSearchService;
        $this->addProductValueCommandHandler = $addProductValueCommandHandler;
        $this->updateProductValueCommandHandler = $updateProductValueCommandHandler;
        $this->removeProductValueCommandHandler = $removeProductValueCommandHandler;
    }

    protected function checkProductOwn(int $userId, int $productId): bool
    {
        $product = $this->productSearchService->getProduct($productId);
        if (!$product instanceof Product) {
            return false;
        }

        if ($product->getUserId() !== $userId) {
            return false;
        }

        return true;
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return array
     */
    public function getProductValues(int $userId, int $productId): array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_PRODUCT_VALUES)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        return $this->productValueSearchService->geValuesOfProduct($productId);
    }

    /**
     * @param int $userId
     * @param array $productValueData
     * @return bool|null
     */
    public function addProductValue(int $userId, array $productValueData): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::ADD_PRODUCT_VALUE)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productValueData['productId'])) {
            return null;
        }

        $command = AddProductValueCommand::createFromArray($productValueData);

        return $this->addProductValueCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param array $productValueData
     * @return bool|null
     */
    public function updateProductValue(int $userId, array $productValueData): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::UPDATE_PRODUCT_VALUE)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productValueData['productId'])) {
            return null;
        }

        $command = UpdateProductValueCommand::createFromArray($productValueData);

        return $this->updateProductValueCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @param int $productValueId
     * @return bool|null
     */
    public function removeProductValue(int $userId, int $productId, int $productValueId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::REMOVE_PRODUCT_VALUE)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        $command = new RemoveProductValueCommand($productValueId);

        return $this->removeProductValueCommandHandler->handle($command);
    }
}