<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\RateInfoRecord;

/**
 * Class that contains response of the getChartRangeRequest command.
 */
final readonly class GetChartRangeRequestResponse extends AbstractResponse
{
    /**
     * Constructor for GetChartRangeRequestResponse.
     *
     * @param  integer          $digits          The number of decimal places for price values.
     * @param  RateInfoRecord[] $rateInfoRecords An array of rate information records.
     */
    public function __construct(public int $digits, public array $rateInfoRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(
            $response['digits'],
            array_map(
                static fn (array $rateInfoRecordData): RateInfoRecord => new RateInfoRecord(...$rateInfoRecordData),
                $response['rateInfos']
            )
        );
    }
}
