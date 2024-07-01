<?php

namespace Timirey\XApi\Responses\Enums;

/**
 * Enum representing the period.
 */
enum Period: int
{
    /**
     * 1 minute.
     */
    case PERIOD_M1 = 1;

    /**
     * 5 minutes.
     */
    case PERIOD_M5 = 5;

    /**
     * 15 minutes.
     */
    case PERIOD_M15 = 15;

    /**
     * 30 minutes.
     */
    case PERIOD_M30 = 30;

    /**
     * 60 minutes (1 hour).
     */
    case PERIOD_H1 = 60;

    /**
     * 240 minutes (4 hours).
     */
    case PERIOD_H4 = 240;

    /**
     * 1440 minutes (1 day).
     */
    case PERIOD_D1 = 1440;

    /**
     * 10080 minutes (1 week).
     */
    case PERIOD_W1 = 10080;

    /**
     * 43200 minutes (30 days).
     */
    case PERIOD_MN1 = 43200;
}
