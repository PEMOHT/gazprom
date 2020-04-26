<?php


namespace Gazprom\Application\Commands\Auction;

use Gazprom\Domain\Auction\AuctionRepository;
use Gazprom\Domain\Auction\Auction;
use Gazprom\Application\Queries\BidHistory\BidHistorySearchService;
use Gazprom\Application\Queries\BidHistory\BidHistory;

/**
 * Class SetWinnerCommandHandler
 * @package Gazprom\Application\Commands\Auction
 */
class SetWinnerCommandHandler
{
    /**
     * @var AuctionRepository
     */
    private AuctionRepository $auctionRepository;
    /**
     * @var BidHistorySearchService
     */
    private BidHistorySearchService $bidHistorySearchService;

    /**
     * SetWinnerCommandHandler constructor.
     * @param AuctionRepository $auctionRepository
     */
    public function __construct(AuctionRepository $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }

    /**
     * @param SetWinnerCommand $command
     * @return bool
     */
    public function handle(SetWinnerCommand $command): bool
    {
        $auction = $this->auctionRepository->find($command->getAuctionId());
        if (!$auction instanceof Auction) {
            return false;
        }

        $bidsHistory = $this->bidHistorySearchService->getBidsForAuction($command->getAuctionId());
        if (!count($bidsHistory)) {
            return false;
        }

        $winnerObj = new class {
            public ?int $userId = null;
            public ?float $value = null;
        };

        array_walk($bidsHistory, function(BidHistory $bidHistory) use ($winnerObj) {
            if (is_null($winnerObj->userId)) {
                $winnerObj->userId = $bidHistory->getUserId();
                $winnerObj->value = $bidHistory->getValue();
            } elseif ($winnerObj->value > $bidHistory->getValue()) {
                $winnerObj->userId = $bidHistory->getUserId();
                $winnerObj->value = $bidHistory->getValue();
            }
        });

        $auction->setWinner($winnerObj->userId);

        return $this->auctionRepository->refresh($auction);
    }
}