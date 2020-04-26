<?php

namespace Gazprom\Domain\Auction;

use Gazprom\Application\Commands\Auction\CreateAuctionCommand;

/**
 * Class Auction
 * @package Gazprom\Domain\Auction
 */
class AuctionFactory
{
    /**
     * @param CreateAuctionCommand $command
     * @return Auction
     * @throws \Exception
     */
    public static function createAuctionFromCommand(CreateAuctionCommand $command): Auction
    {
        return new Auction(
            $command->getCreatorId(),
            $command->getPrice(),
            $command->getStartDate(),
            $command->getEndDate(),
            $command->isAutoStart(),
            $command->getStepTime(),
            $command->getStepType(),
            $command->getStepValue(),
            $command->isActive()
        );
    }
}