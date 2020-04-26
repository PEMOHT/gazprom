<?php


namespace Gazprom\Domain\User;


/**
 * Class User
 * @package Gazprom\Domain\User
 */
class User
{
    const TRADER_ROLE = 1;
    const BUYER_ROLE_ACCREDITED = 2;
    const BUYER_ROLE_NOT_ACCREDITED = 3;

    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $role;
    // todo specification

    /**
     * User constructor.
     * @param int $role
     */
    public function __construct(int $role)
    {
        $this->role = $role;
    }

    /**
     * @param int $role
     */
    public function switchRole(int $role): void
    {
        $this->role = $role;
    }
}