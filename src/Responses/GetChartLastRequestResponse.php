<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\RateInfoRecord;

/**
 * Class that contains response of the getChartLastRequest command.
 */
class GetChartLastRequestResponse extends AbstractResponse
{
    /**
     * Constructor for GetChartLastRequestResponse.
     *
     * @param integer          $digits          The number of decimal places for price values.
     * @param RateInfoRecord[] $rateInfoRecords An array of rate information records.
     */
    public function __construct(public int $digits, public array $rateInfoRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array $response Validated response data.
     *
     * @return static Instance of the response.
     */
    protected static function create(array $response): static
    {
        return new static(
            $response['returnData']['digits'],
            array_map(
                static fn (array $rateInfoRecordData): RateInfoRecord => new RateInfoRecord(...$rateInfoRecordData),
                $response['returnData']['rateInfos']
            )
        );
    }
}
