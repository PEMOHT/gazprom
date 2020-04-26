<?php

namespace Gazprom\Domain\AuctionDocument;

use DateTime;

/**
 * Class AuctionDocument
 * @package Gazprom\Domain\AuctionDocument
 */
class AuctionDocument
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var DateTime
     */
    private DateTime $createDate;
    /**
     * @var int
     */
    private int $auctionId;
    /**
     * @var string
     */
    private string $file;

    /**
     * AuctionDocument constructor.
     * @param string $name
     * @param string $file
     * @param int $auctionId
     * @throws \Exception
     */
    public function __construct(string $name, string $file, int $auctionId)
    {
        $this->auctionId = $auctionId;
        $this->file = $file;
        $this->name = $name;

        $this->createDate = new DateTime();
    }
}