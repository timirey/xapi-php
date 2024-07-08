<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the command type for a trade.
 */
enum Cmd: int
{
    /*
     * Buy command.
     */
    case BUY = 0;

    /*
     * Sell command.
     */
    case SELL = 1;

    /*
     * Buy limit order.
     */
    case BUY_LIMIT = 2;

    /*
     * Sell limit order.
     */
    case SELL_LIMIT = 3;

    /*
     * Buy stop order.
     */
    case BUY_STOP = 4;

    /*
     * Sell stop order.
     */
    case SELL_STOP = 5;

    /*
     * Balance operation (read only).
     */
    case BALANCE = 6;

    /*
     * Credit operation (read only).
     */
    case CREDIT = 7;
}
