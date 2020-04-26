<?php


namespace Gazprom\Application\Commands\AuctionDocument;


use Gazprom\Domain\AuctionDocument\AuctionDocumentRepository;
use Gazprom\Domain\AuctionDocument\AuctionDocument;

/**
 * Class CreateAuctionDocumentCommandHandler
 * @package Gazprom\Application\Commands\AuctionDocument
 */
class CreateAuctionDocumentCommandHandler
{
    /**
     * @var AuctionDocumentRepository
     */
    private AuctionDocumentRepository $auctionDocumentRepository;

    /**
     * CreateAuctionDocumentCommandHandler constructor.
     * @param AuctionDocumentRepository $auctionDocumentRepository
     */
    public function __construct(AuctionDocumentRepository $auctionDocumentRepository)
    {
        $this->auctionDocumentRepository = $auctionDocumentRepository;
    }

    /**
     * @param CreateAuctionDocumentCommand $command
     * @return bool
     * @throws \Exception
     */
    public function handle(CreateAuctionDocumentCommand $command): bool
    {
        $document = new AuctionDocument($command->getName(), $command->getFile(), $command->getAuctionId());

        return $this->auctionDocumentRepository->add($document);
    }
}