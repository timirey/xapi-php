<?php

namespace Timirey\XApi\Exceptions;

use WebSocket\Exception\Exception;

/**
 * Custom response exception.
 *
 * @property string $errorCode Error code of the response.
 * @property string $errorDescr Error description of the response.
 */
class ResponseException extends Exception
{
    /**
     * Constructor for ResponseException.
     *
     * @param string $errorCode Error code.
     * @param string $errorDescr Error description.
     */
    public function __construct(
        protected string $errorCode,
        protected string $errorDescr
    ) {
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
