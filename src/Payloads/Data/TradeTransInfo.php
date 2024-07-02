<?php

namespace Timirey\XApi\Payloads\Data;

use DateTime;
use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Type;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing trade transaction information.
 */
class TradeTransInfo
{
    /**
     * @var integer Pending order expiration time (milliseconds since epoch).
     */
    public int $expiration;

    /**
     * Constructor for TradeTransInfo.
     *
     * @param Cmd         $cmd           Operation code.
     * @param string|null $customComment The value the customer may provide in order to retrieve it later.
     * @param DateTime    $expiration    Pending order expiration time.
     * @param integer     $offset        Trailing offset.
     * @param integer     $order         Position number or 0 for closing/modifications.
     * @param float       $price         Trade price.
     * @param float       $sl            Stop loss.
     * @param string      $symbol        Trade symbol.
     * @param float       $tp            Take profit.
     * @param Type        $type          Trade transaction type.
     * @param float       $volume        Trade volume.
     */
    public function __construct(
        public Cmd $cmd,
        public ?string $customComment,
        DateTime $expiration,
        public int $offset,
        public int $order,
        public float $price,
        public float $sl,
        public string $symbol,
        public float $tp,
        public Type $type,
        public float $volume
    ) {
        $this->expiration = DateTimeHelper::toMilliseconds($expiration);
    }
}
