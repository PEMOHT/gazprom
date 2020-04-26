<?php


namespace Gazprom\Application\Commands\BidHistory;


use Gazprom\Domain\BidHistory\BidHistoryRepository;
use Gazprom\Domain\BidHistory\BidHistory;

/**
 * Class CreateBidsHistoryCommandHandler
 * @package Gazprom\Application\Commands\BidHistory
 */
class CreateBidsHistoryCommandHandler
{
    /**
     * @var BidHistoryRepository
     */
    private BidHistoryRepository $bidHistoryRepository;

    /**
     * CreateBidsHistoryCommandHandler constructor.
     * @param BidHistoryRepository $bidHistoryRepository
     */
    public function __construct(BidHistoryRepository $bidHistoryRepository)
    {
        $this->bidHistoryRepository = $bidHistoryRepository;
    }


    /**
     * @param CreateBidsHistoryCommand $command
     * @return bool
     */
    public function handle(CreateBidsHistoryCommand $command): bool
    {
        $auctionId = $command->getAuctionId();
        $bids = array_map(function(array $bid) use ($auctionId) {
            return new BidHistory(
                $bid['userId'],
                $auctionId,
                $bid['value'],
                $bid['bidDate']
            );
        }, $command->getBids());

        return $this->bidHistoryRepository->addBatch($bids);
    }
}