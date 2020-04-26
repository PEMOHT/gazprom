<?php


namespace Gazprom\Application\Queries\Order;


/**
 * Interface OrderSearchService
 * @package Gazprom\Application\Queries\Order
 */
interface OrderSearchService
{
    /**
     * @param int $orderId
     * @return Order
     */
    public function getOrder(int $orderId): ?Order;

    /**
     * @param int $userId
     * @return array
     */
    public function getTraderOrders(int $userId): array;

    /**
     * @param int $userId
     * @return array
     */
    public function getBuyerOrders(int $userId): array;
}