<?php


namespace Gazprom\Application\Commands\ProductValue;


/**
 * Class UpdateProductValueCommand
 * @package Gazprom\Application\Commands\ProductValue
 */
class UpdateProductValueCommand
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private ?string $name;
    /**
     * @var float
     */
    private ?float $count;
    /**
     * @var int
     */
    private ?int $type;


    /**
     * UpdateProductValueCommand constructor.
     * @param int $id
     * @param string $name
     * @param float $count
     * @param int $type
     */
    public function __construct(int $id, ?string $name, ?float $count, ?int $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->count = $count;
        $this->type = $type;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'] ?? null,
            $data['count'] ?? null,
            $data['type'] ?? null
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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getCount(): ?float
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
    }
}