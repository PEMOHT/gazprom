<?php


namespace Gazprom\Application\Commands\ProductValue;


/**
 * Class RemoveProductValueCommand
 * @package Gazprom\Application\Commands\ProductValue
 */
class RemoveProductValueCommand
{
    /**
     * @var int
     */
    private int $id;


    /**
     * RemoveProductValueCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}