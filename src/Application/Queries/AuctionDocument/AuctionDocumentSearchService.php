<?php


namespace Gazprom\Application\Queries\AuctionDocument;


/**
 * Interface ProductSearchService
 * @package Gazprom\Application\Queries\AuctionDocument
 */
interface AuctionDocumentSearchService
{
    /**
     * @param int $auctionId
     * @return AuctionDocument[]
     */
    public function getDocumentsForAuction(int $auctionId): array;

    /**
     * @param int $id
     * @return AuctionDocument|null
     */
    public function getAuctionDocument(int $id): ?AuctionDocument;


}