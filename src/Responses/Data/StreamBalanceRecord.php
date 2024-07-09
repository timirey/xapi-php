<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing the balance record data in the streaming response.
 */
class StreamBalanceRecord
{
    /**
     * @var float FX equity.
     */
    public float $equityFx;

    /**
     * Constructor for the StreamBalanceRecord class.
     *
     * @param  float $balance        Account balance.
     * @param  float $margin         Account margin.
     * @param  float $equityFX       FX equity.
     * @param  float $equity         Account equity.
     * @param  float $marginLevel    Margin level.
     * @param  float $marginFree     Free margin.
     * @param  float $credit         Account credit.
     * @param  float $stockValue     Stock value.
     * @param  float $stockLock      Stock lock.
     * @param  float $cashStockValue Cash stock value.
     */
    public function __construct(
        public float $balance,
        public float $margin,
        float $equityFX,
        public float $equity,
        public float $marginLevel,
        public float $marginFree,
        public float $credit,
        public float $stockValue,
        public float $stockLock,
        public float $cashStockValue
    ) {
        $this->equityFx = $equityFX;
    }
}
