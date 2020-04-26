<?php


namespace Gazprom\Application\Commands\AuctionDocument;


/**
 * Class RemoveAuctionDocumentCommand
 * @package Gazprom\Application\Commands\AuctionDocument
 */
class RemoveAuctionDocumentCommand
{
    /**
     * @var int
     */
    private int $id;


    /**
     * RemoveAuctionDocumentCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}