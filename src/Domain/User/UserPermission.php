<?php


namespace Gazprom\Domain\User;


/**
 * Class UserPermission
 * @package Gazprom\Domain\User
 */
class UserPermission
{
    const GET_AUCTION_LIST = 'getAuctionList';
    const GET_AUCTION = 'getAuction';
    const CREATE_AUCTION = 'createAuction';
    const UPDATE_AUCTION = 'updateAuction';

    const GET_AUCTION_PRODUCTS = 'getAuctionProducts';
    const GET_ALL_PRODUCTS = 'getAllProducts';
    const GET_PRODUCT = 'getProduct';
    const ADD_PRODUCT_TO_AUCTION = 'addProductToAuction';
    const REMOVE_PRODUCT_FROM_AUCTION = 'removeProductFromAuction';
    const CREATE_PRODUCT = 'createProduct';
    const RENAME_PRODUCT = 'renameProduct';
    const GET_PRODUCTS_BY_ORDER_ID = 'getProductsByOrderId';

    const GET_PRODUCT_VALUES = 'getProductValues';
    const ADD_PRODUCT_VALUE = 'addProductValue';
    const UPDATE_PRODUCT_VALUE = 'updateProductValue';
    const REMOVE_PRODUCT_VALUE = 'removeProductValue';

    const GET_AUCTION_DOCUMENTS = 'getAuctionDocuments';
    const GET_AUCTION_DOCUMENT = 'getAuctionDocument';
    const ADD_AUCTION_DOCUMENT = 'addAuctionDocument';
    const REMOVE_AUCTION_DOCUMENT = 'removeAuctionDocument';

    const CREATE_AUCTION_REQUEST = 'createAuctionRequest';

    const GET_BIDS_HISTORY = 'getBidsHistory';

    const GET_ORDERS_LIST = 'getOrdersList';
    const ACCEPT_ORDER = 'acceptOrder';

    const CREATE_USER = 'createUser';
    const UPDATE_USER = '';
    const BLOCK_USER = '';

    public static array $rolesPermissions = [
        User::TRADER_ROLE => [
            self::GET_AUCTION_LIST,
            self::GET_AUCTION,
            self::CREATE_AUCTION,
            self::UPDATE_AUCTION,

            self::GET_AUCTION_PRODUCTS,
            self::GET_ALL_PRODUCTS,
            self::GET_PRODUCT,
            self::ADD_PRODUCT_TO_AUCTION,
            self::REMOVE_PRODUCT_FROM_AUCTION,
            self::CREATE_PRODUCT,
            self::RENAME_PRODUCT,
            self::GET_PRODUCTS_BY_ORDER_ID,

            self::GET_PRODUCT_VALUES,
            self::ADD_PRODUCT_VALUE,
            self::UPDATE_PRODUCT_VALUE,
            self::REMOVE_PRODUCT_VALUE,

            self::GET_AUCTION_DOCUMENTS,
            self::GET_AUCTION_DOCUMENT,
            self::ADD_AUCTION_DOCUMENT,
            self::REMOVE_AUCTION_DOCUMENT,

            self::GET_BIDS_HISTORY,
            self::GET_ORDERS_LIST,
            self::ACCEPT_ORDER,
        ],
        User::BUYER_ROLE_ACCREDITED => [
            self::GET_AUCTION_LIST,
            self::GET_AUCTION,

            self::GET_AUCTION_PRODUCTS,
            self::GET_PRODUCT,
            self::GET_PRODUCTS_BY_ORDER_ID,

            self::GET_PRODUCT_VALUES,

            self::GET_AUCTION_DOCUMENTS,
            self::GET_AUCTION_DOCUMENT,

            self::CREATE_AUCTION_REQUEST,

            self::GET_ORDERS_LIST,
            self::ACCEPT_ORDER,
        ],
        User::BUYER_ROLE_NOT_ACCREDITED => [
            self::GET_AUCTION_LIST,
            self::GET_AUCTION,

            self::GET_AUCTION_PRODUCTS,
            self::GET_PRODUCT,

            self::GET_PRODUCT_VALUES,

            self::GET_AUCTION_DOCUMENTS,
            self::GET_AUCTION_DOCUMENT,
        ]
    ];
    
    private function __construct()
    {
    }
}