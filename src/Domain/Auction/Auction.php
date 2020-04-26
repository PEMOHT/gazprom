<?php

namespace Gazprom\Domain\Auction;

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
     * Auction constructor.
     * @param int $creatorId
     * @param float $price
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param bool $autoStart
     * @param int $stepTime
     * @param int $stepType
     * @param float $stepValue
     * @param bool $isActive
     * @throws \Exception
     */
    public function __construct(int $creatorId, float $price, DateTime $startDate, DateTime $endDate, bool $autoStart, int $stepTime, int $stepType, float $stepValue, bool $isActive)
    {
        $this->creatorId = $creatorId;
        $this->price = $price;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->autoStart = $autoStart;
        $this->stepTime = $stepTime;
        $this->stepType = $stepType;
        $this->stepValue = $stepValue;
        $this->isActive = $isActive;

        $this->auctionWinner = null;

        $this->createDate = new DateTime();
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function updateDetails(array $data): void
    {
        $updatingFields = [
            'price', 'startDate', 'endDate', 'autoStart', 'stepTime', 'stepType', 'stepValue', 'isActive',
        ];

        $isUpdated = new class() {
            public bool $isUpdated = false;
        };

        foreach ($updatingFields as $fieldName) {
            (function(array $data, string $filedName) use ($isUpdated): void {
                if (isset($data[$filedName])) {
                    $this->$filedName = $data[$filedName];
                    $isUpdated->isUpdated = true;
                }
            })($data, $fieldName);
        }

        if ($isUpdated->isUpdated) {
            $this->lastUpdate = new DateTime();
        }
    }

    /**
     * @param int $userId
     */
    public function setWinner(int $userId): void
    {
        $this->auctionWinner = $userId;
    }
}