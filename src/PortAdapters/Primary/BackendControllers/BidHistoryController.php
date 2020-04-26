<?php


namespace Gazprom\PortAdapters\Primary\BackendControllers;


use Gazprom\Application\Commands\BidHistory\CreateBidsHistoryCommandHandler;
use Gazprom\Application\Commands\BidHistory\CreateBidsHistoryCommand;
use Gazprom\Application\Commands\Order\CreateOrderCommand;
use Gazprom\Application\Commands\Auction\SetWinnerCommand;
use Gazprom\Application\Commands\Auction\SetWinnerCommandHandler;
use Gazprom\Application\Commands\Order\CreateOrderCommandHandler;
use RuntimeException;

/**
 * Class BidHistoryController
 * @package Gazprom\PortAdapters\Primary\BackendControllers
 */
abstract class BidHistoryController
{
    private CreateBidsHistoryCommandHandler $createBidsHistoryCommandHandler;
    private SetWinnerCommandHandler $setWinnerCommandHandler;
    private CreateOrderCommandHandler $createOrderCommandHandler;

    /**
     * BidHistoryController constructor.
     * @param CreateBidsHistoryCommandHandler $createBidsHistoryCommandHandler
     */
    public function __construct(
        CreateBidsHistoryCommandHandler $createBidsHistoryCommandHandler)
    {
        $this->createBidsHistoryCommandHandler = $createBidsHistoryCommandHandler;
    }

    /**
     * @param int $auctionId
     * @param array $bids
     * @return void
     */
    public function takeBidHistory(int $auctionId, array $bids): void
    {
        $createBidsHistoryCommand = new CreateBidsHistoryCommand($bids, $auctionId);

        $isSaved = $this->createBidsHistoryCommandHandler->handle($createBidsHistoryCommand);

        if (!$isSaved) {
            throw new RuntimeException("Bids not saved for auction $auctionId");
        }

        $isSaved = $this->setWinnerCommandHandler->handle(new SetWinnerCommand($auctionId));

        if (!$isSaved) {
            throw new RuntimeException("Winner isn't saved for auction $auctionId");
        }

        $createOrderCommand = new CreateOrderCommand($auctionId);

        $isSaved = $this->createOrderCommandHandler->handle($createOrderCommand);

        if (!$isSaved) {
            throw new RuntimeException("Order creating error, auction Id $auctionId");
        }
    }
}