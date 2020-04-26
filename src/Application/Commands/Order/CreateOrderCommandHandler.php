<?php


namespace Gazprom\Application\Commands\Order;


use Gazprom\Domain\Order\OrderRepository;
use Gazprom\Application\Queries\Auction\AuctionSearchService;
use Gazprom\Application\Queries\Auction\Auction;
use Gazprom\Domain\Order\Order;

/**
 * Class CreateOrderCommandHandler
 * @package Gazprom\Application\Commands\Order
 */
class CreateOrderCommandHandler
{
    /**
     * @var OrderRepository
     */
    private OrderRepository $orderRepository;
    /**
     * @var AuctionSearchService
     */
    private AuctionSearchService $auctionSearchService;

    /**
     * CreateOrderCommandHandler constructor.
     * @param OrderRepository $orderRepository
     * @param AuctionSearchService $auctionSearchService
     */
    public function __construct(OrderRepository $orderRepository, AuctionSearchService $auctionSearchService)
    {
        $this->orderRepository = $orderRepository;
        $this->auctionSearchService = $auctionSearchService;
    }

    public function handle(CreateOrderCommand $command): bool
    {
        $auction = $this->auctionSearchService->getAuction($command->getAuctionId());
        if (!$auction instanceof Auction) {
            return false;
        }

        $order = new Order($auction->getCreatorId(), $auction->getAuctionWinner(), $auction->getId());

        return $this->orderRepository->add($order);
    }
}