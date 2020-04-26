<?php

namespace Gazprom\Domain\Product;

/**
 * Class Product
 * @package Gazprom\Domain\Product
 */
class Product
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
     * @var int
     */
    private int $userId;
    /**
     * @var int|null
     */
    private ?int $attachedTo;

    /**
     * Product constructor.
     * @param string $name
     * @param int $userId
     */
    public function __construct(string $name, int $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
        $this->attachedTo = null;
    }

    /**
     * @param int $auctionId
     * @return bool
     */
    public function attach(int $auctionId): bool
    {
        if (is_null($this->attachedTo)) {
            $this->attachedTo = $auctionId;
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function detach(): void
    {
        $this->attachedTo = null;
    }

    /**
     * @param string $name
     */
    public function rename(string $name): void
    {
        $this->name = $name;
    }
}