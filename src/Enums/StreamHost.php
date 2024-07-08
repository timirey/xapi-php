<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the WebSocket stream host URLs for xStation5 API.
 */
enum StreamHost: string
{
    /**
     * Demo account stream host URL.
     */
    case DEMO = 'wss://ws.xtb.com/demoStream';

    /**
     * Real account stream host URL.
     */
    case REAL = 'wss://ws.xtb.com/realStream';
}
