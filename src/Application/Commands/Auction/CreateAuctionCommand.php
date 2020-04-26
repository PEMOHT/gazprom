<?php


namespace Gazprom\Application\Commands\Auction;


use DateTime;

/**
 * Class CreateAuctionCommand
 * @package Gazprom\Application\Commands\Auction
 */
class CreateAuctionCommand
{
    /**
     * @var bool
     */
    private bool $isActive;

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
     * CreateAuctionCommand constructor.
     * @param int $creatorId
     * @param float $price
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param bool $autoStart
     * @param int $stepTime
     * @param int $stepType
     * @param float $stepValue
     * @param bool $isActive
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
    }

    /**
     * @param array $data
     * @param int|null $creatorId
     * @return static
     */
    public static function createFromArray(array $data, ?int $creatorId = null): self
    {
        return new self(
            $creatorId ?? $data['creatorId'],
            $data['price'],
            $data['startDate'],
            $data['endDate'],
            $data['autoStart'],
            $data['stepTime'],
            $data['stepType'],
            $data['stepValue'],
            $data['isActive']
        );
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
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
}