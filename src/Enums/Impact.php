<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the impact level.
 */
enum Impact: string
{
    /**
     * Low impact.
     */
    case LOW = '1';

    /**
     * Medium impact.
     */
    case MEDIUM = '2';

    /**
     * High impact.
     */
    case HIGH = '3';
}
