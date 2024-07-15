<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the socket stream host URLs for xStation5 API.
 */
enum StreamHost: string
{
    /**
     * Demo account stream host URL.
     */
     case DEMO = 'ssl://xapi.xtb.com:5125';

    /**
     * Real account stream host URL.
     */
     case REAL = 'ssl://xapi.xtb.com:5113';
}
