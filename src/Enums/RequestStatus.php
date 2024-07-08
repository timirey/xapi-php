<?php

namespace Timirey\XApi\Enums;

/**
 * Enum representing the request status.
 */
enum RequestStatus: int
{
    /**
     * Error status.
     */
    case ERROR = 0;

    /**
     * Pending status.
     */
    case PENDING = 1;

    /**
     * Accepted status. The transaction has been executed successfully.
     */
    case ACCEPTED = 3;

    /**
     * Rejected status. The transaction has been rejected.
     */
    case REJECTED = 4;
}
