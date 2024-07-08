<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the source of price.
 */
enum QuoteId: int
{
    /**
     * Fixed source.
     */
    case FIXED = 1;

    /**
     * Float source.
     */
    case FLOAT = 2;

    /**
     * Depth source.
     */
    case DEPTH = 3;

    /**
     * Cross source.
     */
    case CROSS = 4;

    /**
     * Unknown, not documented.
     */
    case FIVE = 5;
}
