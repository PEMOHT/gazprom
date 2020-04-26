<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Exception;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\Auction\AuctionSearchService;
use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Application\Commands\Auction\CreateAuctionCommand;
use Gazprom\Application\Commands\Auction\CreateAuctionCommandHandler;
use Gazprom\Application\Commands\Auction\UpdateAuctionCommand;
use Gazprom\Application\Commands\Auction\UpdateAuctionCommandHandler;

/**
 * Class AuctionController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class AuctionController extends AbstractController
{
    /**
     * @var AuctionSearchService
     */
    private AuctionSearchService $auctionSearchService;
    /**
     * @var CreateAuctionCommandHandler
     */
    private CreateAuctionCommandHandler $createAuctionCommandHandler;
    /**
     * @var UpdateAuctionCommandHandler
     */
    private UpdateAuctionCommandHandler $updateAuctionCommandHandler;

    /**
     * AuctionController constructor.
     * @param UserSearchService $userSearchService
     * @param AuctionSearchService $auctionSearchService
     * @param CreateAuctionCommandHandler $createAuctionCommandHandler
     * @param UpdateAuctionCommandHandler $updateAuctionCommandHandler
     */
    public function __construct(
        UserSearchService $userSearchService,

        AuctionSearchService $auctionSearchService,
        CreateAuctionCommandHandler $createAuctionCommandHandler,
        UpdateAuctionCommandHandler $updateAuctionCommandHandler
    )
    {
        parent::__construct($userSearchService);

        $this->auctionSearchService = $auctionSearchService;
        $this->createAuctionCommandHandler = $createAuctionCommandHandler;
        $this->updateAuctionCommandHandler = $updateAuctionCommandHandler;
    }

    protected function checkAuctionOwn(int $userId, int $auctionId): bool
    {
        $auction = $this->auctionSearchService->getAuction($auctionId);
        if (!$auction instanceof Auction) {
            return false;
        }

        if ($auction->getCreatorId() !== $userId) {
            return false;
        }

        return true;
    }

    /**
     * @param int $userId
     * @return array|null
     */
    public function getAuctionList(int $userId): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_AUCTION_LIST)) {
            return null;
        }

        return $this->auctionSearchService->getAllForUser($userId);
    }

    /**
     * @param int $userId
     * @param int $auctionId
     * @return Auction|null
     */
    public function getAuction(int $userId, int $auctionId): ?Auction
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_AUCTION)) {
            return null;
        }

        return $this->auctionSearchService->getAuction($auctionId);
    }

    /**
     * @param int $userId
     * @param array $auctionData
     * @return bool
     * @throws Exception
     */
    public function createAuction(int $userId, array $auctionData): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::CREATE_AUCTION)) {
            return null;
        }

        $command = CreateAuctionCommand::createFromArray($auctionData, $userId);

        return $this->createAuctionCommandHandler->handle($command);
    }

    /**
     * @param int $userId
     * @param array $auctionData
     * @return bool
     * @throws Exception
     */
    public function updateAuction(int $userId, array $auctionData): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::UPDATE_AUCTION)) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionData['id'])) {
            return null;
        }

        $command = UpdateAuctionCommand::createFromArray($auctionData);

        return $this->updateAuctionCommandHandler->handle($command);
    }
}