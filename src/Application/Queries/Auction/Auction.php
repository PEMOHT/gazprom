<?php

namespace Gazprom\Application\Queries\Auction;

use DateTime;

/**
 * Class Auction
 * @package Gazprom\Domain\Auction
 */
class Auction
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var bool
     */
    private bool $isActive;
    /**
     * @var DateTime
     */
    private DateTime $createDate;
    /**
     * @var DateTime|null
     */
    private ?DateTime $lastUpdate;
    /**
     * @var int
     */
    private int $creatorId;
    /**
     * @var float
     */
    private float $price;

    /**
     * @var DateTime
     */
    private DateTime $startDate;
    /**
     * @var DateTime
     */
    private DateTime $endDate;
    /**
     * @var bool
     */
    private bool $autoStart;

    /**
     * @var int
     */
    private int $stepTime;
    /**
     * @var int
     */
    private int $stepType;
    /**
     * @var float
     */
    private float $stepValue;

    /**
     * @var int|null
     */
    private ?int $auctionWinner;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return DateTime
     */
    public function getCreateDate(): DateTime
    {
        return $this->createDate;
    }

    /**
     * @return DateTime|null
     */
    public function getLastUpdate(): ?DateTime
    {
        return $this->lastUpdate;
    }

    /**
     * @return int
     */
    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @return bool
     */
    public function isAutoStart(): bool
    {
        return $this->autoStart;
    }

    /**
     * @return int
     */
    public function getStepTime(): int
    {
        return $this->stepTime;
    }

    /**
     * @return int
     */
    public function getStepType(): int
    {
        return $this->stepType;
    }

    /**
     * @return float
     */
    public function getStepValue(): float
    {
        return $this->stepValue;
    }

    /**
     * @return int|null
     */
    public function getAuctionWinner(): ?int
    {
        return $this->auctionWinner;
    }
}