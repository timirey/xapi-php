<?php

namespace Timirey\XApi\Exceptions;

use WebSocket\Exception\Exception;

/**
 * Custom error response exception.
 */
class ErrorResponseException extends Exception
{
    /**
     * Constructor for ErrorResponseException.
     *
     * @param  string  $errorCode  Error code.
     * @param  string  $errorDescr  Error description.
     */
    public function __construct(protected string $errorCode, protected string $errorDescr)
    {
        parent::__construct("$errorCode: $errorDescr");
    }

    /**
     * Get the error code.
     *
     * @return string Error code.
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Get the error description.
     *
     * @return string Error description.
     */
    public function getErrorDescr(): string
    {
        return $this->errorDescr;
    }
}
