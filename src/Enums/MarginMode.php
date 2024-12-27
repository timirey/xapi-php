<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the margin mode.
 */
enum MarginMode: int
{
    /**
     * Forex.
     */
    case FOREX = 101;

    /**
     * CFD leveraged.
     */
    case CFD_LEVERAGED = 102;

    /**
     * CFD.
     */
    case CFD = 103;

    /**
     * Unknown, not documented.
     */
    case UNKNOWN = 104;
}
