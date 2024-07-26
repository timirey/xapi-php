<?php

namespace Timirey\XApi\Responses\Data;

use DateTime;
use Timirey\XApi\Enums\Side;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class representing an IB record.
 */
readonly class IbRecord
{
    /**
     * @var Side|null Operation code or null if not allowed to view.
     */
    public ?Side $side;

    /**
     * @var DateTime|null Time the record was created or null if not allowed to view.
     */
    public ?DateTime $timestamp;

    /**
     * Constructor for IbRecord.
     *
     * @param  float|null   $closePrice IB close price or null if not allowed to view.
     * @param  string|null  $login      IB user login or null if not allowed to view.
     * @param  float|null   $nominal    IB nominal or null if not allowed to view.
     * @param  float|null   $openPrice  IB open price or null if not allowed to view.
     * @param  integer|null $side       Operation code or null if not allowed to view.
     * @param  string|null  $surname    IB user surname or null if not allowed to view.
     * @param  string|null  $symbol     Symbol or null if not allowed to view.
     * @param  integer|null $timestamp  Time the record was created or null if not allowed to view.
     * @param  float|null   $volume     Volume in lots or null if not allowed to view.
     */
    final public function __construct(
        public ?float $closePrice,
        public ?string $login,
        public ?float $nominal,
        public ?float $openPrice,
        ?int $side,
        public ?string $surname,
        public ?string $symbol,
        ?int $timestamp,
        public ?float $volume
    ) {
        $this->side = $side !== null ? Side::from($side) : null;
        $this->timestamp = $timestamp !== null ? DateTimeHelper::fromMilliseconds($timestamp) : null;
    }
}
