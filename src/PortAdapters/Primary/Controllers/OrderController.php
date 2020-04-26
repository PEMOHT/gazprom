<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Application\Queries\Order\OrderSearchService;
use Gazprom\Domain\User\User as UserDomain;
use Gazprom\Application\Queries\User\User;
use Gazprom\Application\Queries\Order\Order;
use Gazprom\Application\Commands\Order\AcceptOrderCommand;
use Gazprom\Application\Commands\Order\AcceptOrderCommandHandler;

/**
 * Class OrderController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class OrderController extends AbstractController
{
    /**
     * @var OrderSearchService
     */
    private OrderSearchService $orderSearchService;
    /**
     * @var AcceptOrderCommandHandler
     */
    private AcceptOrderCommandHandler $acceptOrderCommandHandler;


    /**
     * OrderController constructor.
     * @param UserSearchService $userSearchService
     * @param OrderSearchService $orderSearchService
     * @param AcceptOrderCommandHandler $acceptOrderCommandHandler
     */
    public function __construct(
        UserSearchService $userSearchService,

        OrderSearchService $orderSearchService,
        AcceptOrderCommandHandler $acceptOrderCommandHandler
    )
    {
        parent::__construct($userSearchService);

        $this->orderSearchService = $orderSearchService;
        $this->acceptOrderCommandHandler = $acceptOrderCommandHandler;
    }

    /**
     * @param int $userId
     * @return array|null
     */
    public function getOrdersList(int $userId): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_ORDERS_LIST)) {
            return null;
        }

        $user = $this->userSearchService->find($userId);
        if (!$user instanceof User) {
            return null;
        }

        if ($user->getRole() === UserDomain::TRADER_ROLE) {
            return $this->orderSearchService->getTraderOrders($userId);
        } elseif ($user->getRole() === UserDomain::BUYER_ROLE_ACCREDITED) {
            return $this->orderSearchService->getBuyerOrders($userId);
        } else {
            return null;
        }
    }

    /**
     * @param int $userId
     * @param int $orderId
     * @return Auction|null
     */
    public function acceptOrder(int $userId, int $orderId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::ACCEPT_ORDER)) {
            return null;
        }

        $order = $this->orderSearchService->getOrder($orderId);
        if (!$order instanceof Order) {
            return null;
        }

        $user = $this->userSearchService->find($userId);
        if (!$user instanceof User) {
            return null;
        }

        switch (true) {
            case $user->getRole() === UserDomain::TRADER_ROLE && $order->getTraderId() === $user->getId():
            case $user->getRole() === UserDomain::BUYER_ROLE_ACCREDITED && $order->getBuyerId() === $user->getId():
                $command = new AcceptOrderCommand($orderId, $userId, $user->getRole());

                return $this->acceptOrderCommandHandler->handle($command);
            default:
                return null;
        }
    }
}