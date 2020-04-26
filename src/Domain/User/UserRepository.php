<?php


namespace Gazprom\Domain\User;


/**
 * Interface UserRepository
 * @package Gazprom\Domain\ProductValue
 */
interface UserRepository
{
    /**
     * @param User $user
     * @return bool
     */
    public function add(User $user): bool;

    /**
     * @param User $user
     * @return bool
     */
    public function refresh(User $user): bool;

    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User;
}