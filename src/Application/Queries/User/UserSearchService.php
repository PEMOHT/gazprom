<?php


namespace Gazprom\Application\Queries\User;


/**
 * Interface UserSearchService
 * @package Gazprom\Application\Queries\User
 */
interface UserSearchService
{
    /**
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User;
}