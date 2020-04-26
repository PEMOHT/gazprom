<?php


namespace Gazprom\PortAdapters\Primary\Controllers;

use Exception;

use Gazprom\Domain\User\UserPermission;

use Gazprom\Application\Queries\Auction\AuctionSearchService;
use Gazprom\Application\Queries\User\UserSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Application\Queries\AuctionDocument\AuctionDocumentSearchService;
use Gazprom\Application\Queries\AuctionDocument\AuctionDocument;
use Gazprom\Application\Commands\AuctionDocument\CreateAuctionDocumentCommandHandler;
use Gazprom\Application\Commands\AuctionDocument\CreateAuctionDocumentCommand;
use Gazprom\Application\Commands\AuctionDocument\RemoveAuctionDocumentCommandHandler;
use Gazprom\Application\Commands\AuctionDocument\RemoveAuctionDocumentCommand;

/**
 * Class AuctionDocumentController
 * @package Gazprom\PortAdapters\Primary\Controllers
 */
abstract class AuctionDocumentController extends AbstractController
{
    /**
     * @var AuctionSearchService
     */
    private AuctionSearchService $auctionSearchService;
    /**
     * @var AuctionDocumentSearchService
     */
    private AuctionDocumentSearchService $auctionDocumentSearchService;
    /**
     * @var CreateAuctionDocumentCommandHandler
     */
    private CreateAuctionDocumentCommandHandler $createAuctionDocumentCommandHandler;
    /**
     * @var RemoveAuctionDocumentCommandHandler
     */
    private RemoveAuctionDocumentCommandHandler $removeAuctionDocumentCommandHandler;


    /**
     * AuctionDocumentController constructor.
     * @param UserSearchService $userSearchService
     * @param AuctionSearchService $auctionSearchService
     * @param AuctionDocumentSearchService $auctionDocumentSearchService
     * @param CreateAuctionDocumentCommandHandler $createAuctionDocumentCommandHandler
     * @param RemoveAuctionDocumentCommandHandler $removeAuctionDocumentCommandHandler
     */
    public function __construct(
        UserSearchService $userSearchService,

        AuctionSearchService $auctionSearchService,
        AuctionDocumentSearchService $auctionDocumentSearchService,
        CreateAuctionDocumentCommandHandler $createAuctionDocumentCommandHandler,
        RemoveAuctionDocumentCommandHandler $removeAuctionDocumentCommandHandler
    )
    {
        parent::__construct($userSearchService);

        $this->auctionSearchService = $auctionSearchService;
        $this->auctionDocumentSearchService = $auctionDocumentSearchService;
        $this->createAuctionDocumentCommandHandler = $createAuctionDocumentCommandHandler;
        $this->removeAuctionDocumentCommandHandler = $removeAuctionDocumentCommandHandler;
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
    public function getAuctionDocuments(int $userId, int $auctionId): ?array
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_AUCTION_DOCUMENTS)) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionId)) {
            return null;
        }

        return $this->auctionDocumentSearchService->getDocumentsForAuction($auctionId);
    }

    /**
     * @param int $userId
     * @param int $auctionDocumentId
     * @return AuctionDocument|null
     */
    public function getAuctionDocument(int $userId, int $auctionDocumentId): ?AuctionDocument
    {
        if (parent::checkUserPermissions($userId, UserPermission::GET_AUCTION_DOCUMENT)) {
            return null;
        }

        $auctionDocument = $this->auctionDocumentSearchService->getAuctionDocument($auctionDocumentId);
        if (!$auctionDocument instanceof AuctionDocument) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionDocument->getAuctionId())) {
            return null;
        }

        return $auctionDocument;
    }

    /**
     * TODO организовать сохранение файла
     * @param int $userId
     * @param int $auctionId
     * @param string $documentName
     * @param string $fileName
     * @return AuctionDocument|null
     * @throws Exception
     */
    public function addAuctionDocument(int $userId, int $auctionId, string $documentName, string $fileName): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::ADD_AUCTION_DOCUMENT)) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionId)) {
            return null;
        }

        $command = new CreateAuctionDocumentCommand($documentName, $fileName, $auctionId);

        return $this->createAuctionDocumentCommandHandler->handle($command);
    }

    /**
     * todo организовать удаление
     * @param int $userId
     * @param int $auctionDocumentId
     * @return AuctionDocument|null
     * @throws Exception
     */
    public function removeAuctionDocument(int $userId, int $auctionDocumentId): ?bool
    {
        if (parent::checkUserPermissions($userId, UserPermission::REMOVE_AUCTION_DOCUMENT)) {
            return null;
        }

        $auctionDocument = $this->auctionDocumentSearchService->getAuctionDocument($auctionDocumentId);
        if (!$auctionDocument instanceof AuctionDocument) {
            return null;
        }

        if (!$this->checkAuctionOwn($userId, $auctionDocument->getAuctionId())) {
            return null;
        }

        $command = new RemoveAuctionDocumentCommand($auctionDocumentId);

        return $this->removeAuctionDocumentCommandHandler->handle($command);
    }
}