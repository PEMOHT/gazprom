<?php


namespace Gazprom\Application\Commands\ProductValue;


/**
 * Class AddProductValueCommand
 * @package Gazprom\Application\Commands\ProductValue
 */
class AddProductValueCommand
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var float
     */
    private float $count;
    /**
     * @var int
     */
    private int $type;
    /**
     * @var int
     */
    private int $productId;

    /**
     * AddProductValueCommand constructor.
     * @param string $name
     * @param float $count
     * @param int $type
     * @param int $productId
     */
    public function __construct(string $name, float $count, int $type, int $productId)
    {
        $this->name = $name;
        $this->count = $count;
        $this->type = $type;
        $this->productId = $productId;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['count'],
            $data['type'],
            $data['productId']
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }
}