<?php

namespace Timirey\XApi\Responses\Enums;

/**
 * Enum representing the profit mode.
 */
enum ProfitMode: int
{
    /**
     * FOREX.
     */
    case FOREX = 5;

    /**
     * CFD.
     */
    case CFD = 6;
}
