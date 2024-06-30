<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\QuotesRecord;
use Timirey\XApi\Responses\Data\TradingHoursRecord;
use Timirey\XApi\Responses\Data\TradingRecord;

/**
 * Class that contains the response of the getTradingHours command.
 */
class GetTradingHoursResponse extends AbstractResponse
{
    /**
     * Constructor for GetTradingHoursResponse.
     *
     * @param TradingHoursRecord[] $tradingHoursRecords
     */
    public function __construct(public array $tradingHoursRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn(array $tradingHoursRecordData): TradingHoursRecord => new TradingHoursRecord(
                array_map(
                    static fn(array $quotesRecordData): QuotesRecord => new QuotesRecord(...$quotesRecordData),
                    $tradingHoursRecordData['quotes']
                ),
                $tradingHoursRecordData['symbol'],
                array_map(
                    static fn(array $tradingRecordData): TradingRecord => new TradingRecord(...$tradingRecordData),
                    $tradingHoursRecordData['trading']
                )
            ),
            $data['returnData']
        ));
    }
}
