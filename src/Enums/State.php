<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the order state.
 */
enum State: string
{
    /**
     * Trade order is modified.
     */
    case MODIFIED = 'Modified';

    /**
     * Trade order is deleted.
     */
    case DELETED = 'Deleted';
}
