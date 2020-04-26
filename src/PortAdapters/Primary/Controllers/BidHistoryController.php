<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Application\Queries\Auction\AuctionSearchService;
use Gazprom\Application\Queries\BidHistory\BidHistorySearchService;

/**
 * Class BidHistoryController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class BidHistoryController extends AbstractController
{
    private AuctionSearchService $auctionSearchService;
    private BidHistorySearchService $bidHistorySearchService;

    /**
     * BidHistoryController constructor.
     * @param UserSearchService $userSearchService
     * @param AuctionSearchService $auctionSearchService
     * @param BidHistorySearchService $bidHistorySearchService
     */
    public function __construct(
        UserSearchService $userSearchService,

        AuctionSearchService $auctionSearchService,
        BidHistorySearchService $bidHistorySearchService
    )
    {
        parent::__construct($userSearchService);

        $this->auctionSearchService = $auctionSearchService;
        $this->bidHistorySearchService = $bidHistorySearchService;
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
     * @param int $auctionId
     * @return array|null
     */
    public function getBidsHistory(int $userId, int $auctionId): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_BIDS_HISTORY)) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionId)) {
            return null;
        }

        return $this->bidHistorySearchService->getBidsForAuction($auctionId);
    }
}