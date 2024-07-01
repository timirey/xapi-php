<?php

namespace Timirey\XApi\Payloads\Data;

use Timirey\XApi\Enums\Cmd;
use Timirey\XApi\Enums\Type;

/**
 * Class representing trade transaction information.
 *
 * todo: find out which properties are optional.
 */
class TradeTransInfo
{
    /**
     * Constructor for TradeTransInfo.
     *
     * @param Cmd $cmd Operation code.
     * @param string|null $customComment The value the customer may provide in order to retrieve it later.
     * @param int $expiration Pending order expiration time.
     * @param int $offset Trailing offset.
     * @param int $order 0 or position number for closing/modifications.
     * @param float $price Trade price.
     * @param float $sl Stop loss.
     * @param string $symbol Trade symbol.
     * @param float $tp Take profit.
     * @param Type $type Trade transaction type.
     * @param float $volume Trade volume.
     */
    public function __construct(
        public Cmd $cmd,
        public ?string $customComment,
        public int $expiration,
        public int $offset,
        public int $order,
        public float $price,
        public float $sl,
        public string $symbol,
        public float $tp,
        public Type $type,
        public float $volume
    ) {
    }
}
