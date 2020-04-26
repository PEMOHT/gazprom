<?php


namespace Gazprom\Application\Commands\AuctionDocument;


use Gazprom\Domain\AuctionDocument\AuctionDocumentRepository;
use Gazprom\Domain\AuctionDocument\AuctionDocument;

/**
 * Class RemoveAuctionDocumentCommandHandler
 * @package Gazprom\Application\Commands\AuctionDocument
 */
class RemoveAuctionDocumentCommandHandler
{
    /**
     * @var AuctionDocumentRepository
     */
    private AuctionDocumentRepository $auctionDocumentRepository;

    /**
     * RemoveAuctionDocumentCommandHandler constructor.
     * @param AuctionDocumentRepository $auctionDocumentRepository
     */
    public function __construct(AuctionDocumentRepository $auctionDocumentRepository)
    {
        $this->auctionDocumentRepository = $auctionDocumentRepository;
    }

    /**
     * @param RemoveAuctionDocumentCommand $command
     * @return bool
     * @throws \Exception
     */
    public function handle(RemoveAuctionDocumentCommand $command): bool
    {
        $document = $this->auctionDocumentRepository->find($command->getId());
        if (!$document instanceof AuctionDocument) {
            return false;
        }

        return $this->auctionDocumentRepository->remove($document);
    }
}