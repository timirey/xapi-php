<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the WebSocket host URLs for xStation5 API.
 */
enum Host: string
{
    /**
     * Demo account host URL.
     */
    case DEMO = 'ssl://xapi.xtb.com:5124';

    /**
     * Real account host URL.
     */
    case REAL = 'ssl://xapi.xtb.com:5112';
}
