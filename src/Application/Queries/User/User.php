<?php


namespace Gazprom\Application\Queries\User;


/**
 * Class User
 * @package Gazprom\Application\Queries\User
 */
class User
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $role;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }


    // TODO all other fields if needed
}