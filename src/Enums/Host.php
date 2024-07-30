<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the account types for xStation5 API.
 */
enum Host: string
{
    /**
     * @const Demo account type.
     */
    case DEMO = 'demo';

    /**
     * @const Real account type.
     */
    case REAL = 'real';

    /**
     * Get the request host URL based on the type.
     *
     * @return string The request host URL.
     */
    public function getRequestHost(): string
    {
        return match ($this) {
            self::DEMO => 'ssl://xapi.xtb.com:5124',
            self::REAL => 'ssl://xapi.xtb.com:5112',
        };
    }

    /**
     * Get the stream host URL based on the type.
     *
     * @return string The stream host URL.
     */
    public function getStreamHost(): string
    {
        return match ($this) {
            self::DEMO => 'ssl://xapi.xtb.com:5125',
            self::REAL => 'ssl://xapi.xtb.com:5113',
        };
    }
}
