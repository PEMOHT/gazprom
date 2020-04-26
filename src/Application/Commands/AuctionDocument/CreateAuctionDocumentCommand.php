<?php


namespace Gazprom\Application\Commands\AuctionDocument;


/**
 * Class CreateAuctionDocumentCommand
 * @package Gazprom\Application\Commands\AuctionDocument
 */
class CreateAuctionDocumentCommand
{
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $file;

    /**
     * CreateAuctionDocumentCommand constructor.
     * @param int $auctionId
     * @param string $file
     * @param string $name
     */
    public function __construct(string $name, string $file, int $auctionId)
    {
        $this->name = $name;
        $this->file = $file;
        $this->auctionId = $auctionId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAuctionId(): int
    {
        return $this->auctionId;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }
}