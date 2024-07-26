<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\QuotesRecord;
use Timirey\XApi\Responses\Data\TradingHoursRecord;
use Timirey\XApi\Responses\Data\TradingRecord;

/**
 * Class that contains the response of the getTradingHours command.
 */
readonly class GetTradingHoursResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradingHoursResponse.
     *
     * @param  TradingHoursRecord[] $tradingHoursRecords TradingHoursRecord instances.
     */
    final public function __construct(public array $tradingHoursRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(array_map(
            static fn (array $tradingHoursRecordData): TradingHoursRecord => new TradingHoursRecord(
                array_map(
                    static fn (array $quotesRecordData): QuotesRecord => new QuotesRecord(...$quotesRecordData),
                    $tradingHoursRecordData['quotes']
                ),
                $tradingHoursRecordData['symbol'],
                array_map(
                    static fn (array $tradingRecordData): TradingRecord => new TradingRecord(...$tradingRecordData),
                    $tradingHoursRecordData['trading']
                )
            ),
            $response['returnData']
        ));
    }
}
