<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing the profit record data in the streaming response.
 */
class ProfitStreamRecord
{
    /**
     * Constructor for the ProfitStreamRecord class.
     *
     * @param  integer $order    Order number.
     * @param  integer $order2   Transaction ID.
     * @param  integer $position Position number.
     * @param  float   $profit   Profit in account currency.
     */
    public function __construct(
        public int $order,
        public int $order2,
        public int $position,
        public float $profit
    ) {
    }
}
