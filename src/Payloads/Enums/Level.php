<?php

namespace Timirey\XApi\Payloads\Enums;

/**
 * Enum representing the price level.
 */
enum Level: int
{
    /**
     * All available levels.
     */
    case ALL = -1;

    /**
     * Base level bid and ask price for instrument.
     */
    case BASE = 0;

    /**
     * Specified level.
     */
    case SPECIFIED = 1;
}
