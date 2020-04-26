<?php


namespace Gazprom\Application\Commands\Auction;


/**
 * Class UpdateAuctionCommand
 * @package Gazprom\Application\Commands\Auction
 */
class UpdateAuctionCommand
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var array
     */
    private array $data;


    /**
     * UpdateAuctionCommand constructor.
     * @param int $id
     * @param array $data
     */
    public function __construct(int $id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['data']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}