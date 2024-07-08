<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the WebSocket host URLs for xStation5 API.
 */
enum Host: string
{
    /*
     * Demo account host URL.
     */
    case DEMO = 'wss://ws.xtb.com/demo';

    /*
     * Real account host URL.
     */
    case REAL = 'wss://ws.xtb.com/real';
}
