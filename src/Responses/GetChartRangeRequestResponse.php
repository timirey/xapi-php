<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\RateInfoRecord;

/**
 * Class that contains response of the getChartRangeRequest command.
 */
class GetChartRangeRequestResponse extends AbstractResponse
{
    /**
     * Constructor for GetChartRangeRequestResponse.
     *
     * @param int              $digits          The number of decimal places for price values.
     * @param RateInfoRecord[] $rateInfoRecords An array of rate information records.
     */
    public function __construct(public int $digits, public array $rateInfoRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array $data Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(
            $data['returnData']['digits'],
            array_map(
                static fn (array $rateInfoRecordData): RateInfoRecord => new RateInfoRecord(...$rateInfoRecordData),
                $data['returnData']['rateInfos']
            )
        );
    }
}
