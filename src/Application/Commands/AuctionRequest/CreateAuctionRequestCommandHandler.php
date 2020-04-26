<?php


namespace Gazprom\Application\Commands\AuctionRequest;


use Gazprom\Domain\AuctionRequest\AuctionRequestRepository;
use Gazprom\Domain\AuctionRequest\AuctionRequest;

/**
 * Class CreateAuctionRequestCommandHandler
 * @package Gazprom\Application\Commands\AuctionRequest
 */
class CreateAuctionRequestCommandHandler
{
    /**
     * @var AuctionRequestRepository
     */
    private AuctionRequestRepository $auctionRequestRepository;

    /**
     * CreateAuctionRequestCommandHandler constructor.
     * @param AuctionRequestRepository $auctionRequestRepository
     */
    public function __construct(AuctionRequestRepository $auctionRequestRepository)
    {
        $this->auctionRequestRepository = $auctionRequestRepository;
    }

    public function handle(CreateAuctionRequestCommand $command): bool
    {
        $request = new AuctionRequest($command->getAuctionId(), $command->getUserId());

        return $this->auctionRequestRepository->add($request);
    }
}