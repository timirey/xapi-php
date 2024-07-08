<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the order type.
 */
enum Type: int
{
    /**
     * Order open, used for opening orders.
     */
    case OPEN = 0;

    /**
     * Order pending, only used in the streaming getTrades command.
     */
    case PENDING = 1;

    /**
     * Order close.
     */
    case CLOSE = 2;

    /**
     * Order modify, only used in the tradeTransaction command.
     */
    case MODIFY = 3;

    /**
     * Order delete, only used in the tradeTransaction command.
     */
    case DELETE = 4;
}
