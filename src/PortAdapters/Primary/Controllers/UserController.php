<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\User\UserSearchService;

/**
 * Class UserController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class UserController extends AbstractController
{

    /**
     * UserController constructor.
     * @param UserSearchService $userSearchService
     */
    public function __construct(
        UserSearchService $userSearchService
    )
    {
        parent::__construct($userSearchService);
    }

    /**
     * todo реализовать создание пользователя, и остальные операции над пользователем
     * @param int $userId
     * @param array $userData
     * @return array|null
     */
    public function createUser(int $userId, array $userData): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::CREATE_USER)) {
            return null;
        }

        return null;
    }
}