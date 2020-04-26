<?php

namespace Gazprom\Application\Commands\Auction;

use Gazprom\Domain\Auction\AuctionRepository;
use Gazprom\Domain\Auction\AuctionFactory;

/**
 * Class GetAuctionListCommandHandler
 * @package Gazprom\Application\Commands\Auction
 */
class CreateAuctionCommandHandler
{
    private AuctionRepository $auctionRepository;

    /**
     * CreateAuctionCommandHandler constructor.
     * @param AuctionRepository $auctionRepository
     */
    public function __construct(AuctionRepository $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }


    /**
     * @param CreateAuctionCommand $command
     * @return bool
     * @throws \Exception
     */
    public function handle(CreateAuctionCommand $command): bool
    {
        $auction = AuctionFactory::createAuctionFromCommand($command);

        return $this->auctionRepository->add($auction);
    }
}