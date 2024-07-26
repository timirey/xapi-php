<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a trading hours record.
 */
final readonly class TradingHoursRecord
{
    /**
     * Constructor for TradingHoursRecord.
     *
     * @param  QuotesRecord[]  $quotes  Array of quotes records.
     * @param  string          $symbol  Symbol.
     * @param  TradingRecord[] $trading Array of trading records.
     */
    public function __construct(public array $quotes, public string $symbol, public array $trading)
    {
    }
}
