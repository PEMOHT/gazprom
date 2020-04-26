<?php

namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\User\User;
use Gazprom\Domain\User\UserPermission;

/**
 * Class AbstractController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class AbstractController
{
    /**
     * @var UserSearchService
     */
    protected UserSearchService $userSearchService;

    /**
     * AbstractController constructor.
     * @param UserSearchService $userSearchService
     */
    public function __construct(UserSearchService $userSearchService)
    {
        $this->userSearchService = $userSearchService;
    }

    /**
     * @param int $userId
     * @param string $action
     * @return bool
     */
    final protected function checkUserPermissions(int $userId, string $action): bool
    {
        $user = $this->userSearchService->find($userId);
        if (!$user instanceof User) {
            return false;
        }

        return in_array($action, UserPermission::$rolesPermissions[$user->getRole()]);
    }
}