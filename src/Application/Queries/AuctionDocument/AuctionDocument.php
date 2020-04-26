<?php


namespace Gazprom\Application\Queries\AuctionDocument;


use DateTime;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getCreateDate(): DateTime
    {
        return $this->createDate;
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