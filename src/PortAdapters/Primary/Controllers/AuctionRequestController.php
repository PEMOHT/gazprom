<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Exception;
use DateTime;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\Auction\AuctionSearchService;
use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Application\Commands\AuctionRequest\CreateAuctionRequestCommandHandler;
use Gazprom\Application\Commands\AuctionRequest\CreateAuctionRequestCommand;

/**
 * Class AuctionRequestController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class AuctionRequestController extends AbstractController
{
    /**
     * @var AuctionSearchService
     */
    private AuctionSearchService $auctionSearchService;
    /**
     * @var CreateAuctionRequestCommandHandler
     */
    private CreateAuctionRequestCommandHandler $createAuctionRequestCommandHandler;


    /**
     * AuctionRequestController constructor.
     * @param UserSearchService $userSearchService
     * @param AuctionSearchService $auctionSearchService
     * @param CreateAuctionRequestCommandHandler $createAuctionRequestCommandHandler
     */
    public function __construct(
        UserSearchService $userSearchService,

        AuctionSearchService $auctionSearchService,
        CreateAuctionRequestCommandHandler $createAuctionRequestCommandHandler

    )
    {
        parent::__construct($userSearchService);

        $this->auctionSearchService = $auctionSearchService;
        $this->createAuctionRequestCommandHandler = $createAuctionRequestCommandHandler;
    }

    /**
     * @param int $userId
     * @param int $auctionId
     * @return bool|null
     * @throws Exception
     */
    public function createAuctionRequest(int $userId, int $auctionId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::CREATE_AUCTION_REQUEST)) {
            return null;
        }

        $auction = $this->auctionSearchService->getAuction($auctionId);
        if (!$auction instanceof Auction) {
            return null;
        }

        if (!$auction->isActive()) {
            return null;
        }

        if ($auction->getStartDate() < new DateTime()) {
            return false;
        }

        $command = new CreateAuctionRequestCommand($userId, $auctionId);

        return $this->createAuctionRequestCommandHandler->handle($command);
    }

    /**
     * todo логично предположить что заявку можно и отменить до начала аукциона
     * @param int $userId
     * @param int $auctionId
     * @return bool|null
     * @throws Exception
     */
    public function removeAuctionRequest(int $userId, int $auctionId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::CREATE_AUCTION_REQUEST)) {
            return null;
        }

        return false;
        // todo реализовать
    }
}