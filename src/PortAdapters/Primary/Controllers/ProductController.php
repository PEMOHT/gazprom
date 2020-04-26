<?php

namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Domain\User\UserPermission;
use Gazprom\Application\Queries\Product\Product;
use Gazprom\Application\Queries\Product\ProductSearchService;
use Gazprom\Application\Commands\Product\AddProductToAuctionCommandHandler;
use Gazprom\Application\Commands\Product\AddProductToAuctionCommand;
use Gazprom\Application\Commands\Product\RemoveProductFromAuctionCommand;
use Gazprom\Application\Commands\Product\RemoveProductFromAuctionCommandHandler;
use Gazprom\Application\Commands\Product\CreateProductCommand;
use Gazprom\Application\Commands\Product\CreateProductCommandHandler;
use Gazprom\Application\Commands\Product\RenameProductCommand;
use Gazprom\Application\Commands\Product\RenameProductCommandHandler;
use Gazprom\Application\Queries\Order\OrderSearchService;
use Gazprom\Application\Queries\Order\Order;

/**
 * Class ProductController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class ProductController extends AbstractController
{
    /**
     * @var ProductSearchService
     */
    private ProductSearchService $productSearchService;
    /**
     * @var AddProductToAuctionCommandHandler
     */
    private AddProductToAuctionCommandHandler $addProductToAuctionCommandHandler;
    /**
     * @var RemoveProductFromAuctionCommandHandler
     */
    private RemoveProductFromAuctionCommandHandler $removeProductFromAuctionCommandHandler;
    /**
     * @var CreateProductCommandHandler
     */
    private CreateProductCommandHandler $createProductCommandHandler;
    /**
     * @var RenameProductCommandHandler
     */
    private RenameProductCommandHandler $renameProductCommandHandler;
    /**
     * @var OrderSearchService
     */
    private OrderSearchService $orderSearchService;

    /**
     * ProductSearchService constructor.
     * @param UserSearchService $userSearchService
     * @param ProductSearchService $auctionSearchService
     * @param AddProductToAuctionCommandHandler $addProductToAuctionCommandHandler
     * @param RemoveProductFromAuctionCommandHandler $removeProductFromAuctionCommandHandler
     * @param CreateProductCommandHandler $createProductCommandHandler
     * @param RenameProductCommandHandler $renameProductCommandHandler
     * @param OrderSearchService $orderSearchService
     */
    public function __construct(
        UserSearchService $userSearchService,

        ProductSearchService $auctionSearchService,
        AddProductToAuctionCommandHandler $addProductToAuctionCommandHandler,
        RemoveProductFromAuctionCommandHandler $removeProductFromAuctionCommandHandler,
        CreateProductCommandHandler $createProductCommandHandler,
        RenameProductCommandHandler $renameProductCommandHandler,
        OrderSearchService $orderSearchService
    )
    {
        parent::__construct($userSearchService);

        $this->productSearchService = $auctionSearchService;
        $this->addProductToAuctionCommandHandler = $addProductToAuctionCommandHandler;
        $this->removeProductFromAuctionCommandHandler = $removeProductFromAuctionCommandHandler;
        $this->createProductCommandHandler = $createProductCommandHandler;
        $this->renameProductCommandHandler = $renameProductCommandHandler;
        $this->orderSearchService = $orderSearchService;
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
     * @param int $auctionId
     * @return array
     */
    public function getAuctionProducts(int $userId, int $auctionId): array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_AUCTION_PRODUCTS)) {
            return null;
        }

        return $this->productSearchService->getAllProductsForAuction($auctionId);
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getAllProducts(int $userId): array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_ALL_PRODUCTS)) {
            return null;
        }

        return $this->productSearchService->getAllProductsForUser($userId);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return Product|null
     */
    public function getProduct(int $userId, int $productId): ?Product
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_PRODUCT)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        return $this->productSearchService->getProduct($productId);
    }

    /**
     * @param int $userId
     * @param int $auctionId
     * @param int $productId
     * @return bool|null
     */
    protected function addProductToAuction(int $userId, int $productId, int $auctionId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::ADD_PRODUCT_TO_AUCTION)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        $command = new AddProductToAuctionCommand($auctionId, $productId);

        return $this->addProductToAuctionCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @return bool|null
     */
    protected function removeProductFromAuction(int $userId, int $productId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::REMOVE_PRODUCT_FROM_AUCTION)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        $command = new RemoveProductFromAuctionCommand($productId);

        return $this->removeProductFromAuctionCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param string $productName
     * @return bool|null
     */
    protected function createProduct(int $userId, string $productName): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::CREATE_PRODUCT)) {
            return null;
        }

        $command = new CreateProductCommand($productName, $userId);

        return $this->createProductCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param int $productId
     * @param string $productName
     * @return bool|null
     */
    protected function renameProduct(int $userId, int $productId, string $productName): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::RENAME_PRODUCT)) {
            return null;
        }

        if (!$this->checkProductOwn($userId, $productId)) {
            return null;
        }

        $command = new RenameProductCommand($productId, $productName);

        return $this->renameProductCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param int $orderId
     * @return array|null
     */
    protected function getProductsByOrderId(int $userId, int $orderId): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_PRODUCTS_BY_ORDER_ID)) {
            return null;
        }

        $order = $this->orderSearchService->getOrder($orderId);
        if (!$order instanceof Order) {
            return null;
        }

        if ($order->getBuyerId() !== $userId && $order->getTraderId() !== $userId) {
            return null;
        }

        return $this->productSearchService->getAllProductsForAuction($order->getAuctionId());
    }
}