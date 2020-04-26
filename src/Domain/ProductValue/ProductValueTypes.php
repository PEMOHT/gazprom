<?php

namespace Gazprom\Domain\ProductValue;

/**
 * Class ProductValueTypes
 * @package Gazprom\Domain\ProductValue
 */
final class ProductValueTypes
{
    const MM = 1;
    const SM = 2;
    const METER = 3;
    const KM = 4;

    const MG = 11;
    const G = 12;
    const KG = 13;
    const TON = 14;
    
    const SQUAD_MM = 21;
    const SQUAD_SM = 22;
    const SQUAD_METER = 23;
    const SQUAD_KM = 24;
    
    const TRIP_MM = 31;
    const TRIP_SM = 32;
    const TRIP_METER = 33;
    const TRIP_KM = 34;
    const LITER = 35;

    const NATURAL = 0;

    public static array $types = [
        self::MM => 'MM',
        self::SM => 'SM',
        self::METER => 'METER',
        self::KM => 'KM',

        self::MG => 'MG',
        self::G => 'G',
        self::KG => 'KG',
        self::TON => 'TON',

        self::SQUAD_MM => 'SQUAD_MM',
        self::SQUAD_SM => 'SQUAD_SM',
        self::SQUAD_METER => 'SQUAD_METER',
        self::SQUAD_KM => 'SQUAD_KM',

        self::TRIP_MM => 'TRIP_MM',
        self::TRIP_SM => 'TRIP_SM',
        self::TRIP_METER => 'TRIP_METER',
        self::TRIP_KM => 'TRIP_KM',
        self::LITER => 'LITER',

        self::NATURAL => 'NATURAL',
    ];

    private function __construct()
    {
    }
}