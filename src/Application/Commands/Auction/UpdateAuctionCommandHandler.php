<?php

namespace Gazprom\Application\Commands\Auction;

use Gazprom\Domain\Auction\AuctionRepository;
use Gazprom\Domain\Auction\Auction;

/**
 * Class UpdateAuctionCommandHandler
 * @package Gazprom\Application\Commands\Auction
 */
class UpdateAuctionCommandHandler
{
    private AuctionRepository $auctionRepository;

    /**
     * UpdateAuctionCommandHandler constructor.
     * @param AuctionRepository $auctionRepository
     */
    public function __construct(AuctionRepository $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }


    /**
     * @param UpdateAuctionCommand $command
     * @return bool
     * @throws \Exception
     */
    public function handle(UpdateAuctionCommand $command): bool
    {
        $auction = $this->auctionRepository->find($command->getId());
        if (!$auction instanceof Auction) {
            return false;
        }

        $auction->updateDetails($command->getData());

        return $this->auctionRepository->refresh($auction);
    }
}