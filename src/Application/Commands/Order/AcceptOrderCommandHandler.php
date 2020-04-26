<?php


namespace Gazprom\Application\Commands\Order;


use Gazprom\Domain\Order\OrderRepository;

use Gazprom\Domain\Order\Order;
use Gazprom\Domain\User\User;

/**
 * Class AcceptOrderCommandHandler
 * @package Gazprom\Application\Commands\Order
 */
class AcceptOrderCommandHandler
{
    /**
     * @var OrderRepository
     */
    private OrderRepository $orderRepository;

    /**
     * AcceptOrderCommandHandler constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(AcceptOrderCommand $command): bool
    {
        $order = $this->orderRepository->find($command->getOrderId());
        if (!$order instanceof Order) {
            return false;
        }

        if ($command->getUserRole() === User::TRADER_ROLE) {
            $order->traderAccept();
        } elseif ($command->getUserRole() === User::BUYER_ROLE_ACCREDITED) {
            $order->buyerAccept();
        } else {
            return false;
        }

        return $this->orderRepository->refresh($order);
    }
}