<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Payloads\Data\ChartRangeInfoRecord;

/**
 * Class that contains payload for the getChartRangeRequest command.
 */
final class GetChartRangeRequestPayload extends AbstractPayload
{
    /**
     * Constructor for GetChartRangeRequestPayload.
     *
     * @param  ChartRangeInfoRecord $chartRangeInfoRecord Chart range info parameters.
     */
    public function __construct(ChartRangeInfoRecord $chartRangeInfoRecord)
    {
        $this->parameters['info'] = $chartRangeInfoRecord;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getChartRangeRequest';
    }
}
