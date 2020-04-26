<?php


namespace Gazprom\Application\Commands\Order;


/**
 * Class AcceptOrderCommand
 * @package Gazprom\Application\Commands\Order
 */
class AcceptOrderCommand
{
    /**
     * @var int
     */
    private int $orderId;
    /**
     * @var int
     */
    private int $userId;
    /**
     * @var int
     */
    private int $userRole;

    /**
     * AcceptOrderCommand constructor.
     * @param int $orderId
     * @param int $userId
     * @param int $userRole
     */
    public function __construct(int $orderId, int $userId, int $userRole)
    {
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->userRole = $userRole;
    }

    /**
     * @return int
     */
    public function getUserRole(): int
    {
        return $this->userRole;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}