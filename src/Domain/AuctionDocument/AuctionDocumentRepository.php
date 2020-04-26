<?php


namespace Gazprom\Domain\AuctionDocument;


/**
 * Interface AuctionDocumentRepository
 * @package Gazprom\Domain\AuctionDocument
 */
interface AuctionDocumentRepository
{
    /**
     * @param AuctionDocument $document
     * @return bool
     */
    public function add(AuctionDocument $document): bool;

    /**
     * @param AuctionDocument $document
     * @return bool
     */
    public function remove(AuctionDocument $document): bool;

    /**
     * @param int $id
     * @return AuctionDocument|null
     */
    public function find(int $id): ?AuctionDocument;
}