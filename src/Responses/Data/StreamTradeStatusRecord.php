<?php

namespace Timirey\XApi\Responses\Data;

use Timirey\XApi\Enums\RequestStatus;

/**
 * Class representing the trade status record data in the streaming response.
 */
class StreamTradeStatusRecord
{
    /**
     * @var RequestStatus Request status.
     */
    public RequestStatus $requestStatus;

    /**
     * Constructor for the StreamTradeStatusRecord class.
     *
     * @param string      $customComment Custom comment.
     * @param string|null $message       Message.
     * @param int         $order         Unique order number.
     * @param float       $price         Price in base currency.
     * @param int         $requestStatus Request status code.
     */
    public function __construct(
        public string $customComment,
        public ?string $message,
        public int $order,
        public float $price,
        int $requestStatus
    ) {
        $this->requestStatus = RequestStatus::from($requestStatus);
    }
}
