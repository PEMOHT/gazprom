<?php


namespace Gazprom\Domain\Order;


/**
 * Interface OrderRepository
 * @package Gazprom\Domain\Order
 */
interface OrderRepository
{
    /**
     * @param Order $order
     * @return bool
     */
    public function add(Order $order): bool;

    /**
     * @param Order $order
     * @return bool
     */
    public function refresh(Order $order): bool;

    /**
     * @param int $orderId
     * @return Order|null
     */
    public function find(int $orderId): ?Order;
}