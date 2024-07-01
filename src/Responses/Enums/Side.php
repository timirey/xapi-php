<?php

namespace Timirey\XApi\Responses\Enums;

/**
 * Enum representing the side of a trade.
 */
enum Side: int
{
    /**
     * Buy side.
     */
    case BUY = 0;

    /**
     * Sell side.
     */
    case SELL = 1;
}
