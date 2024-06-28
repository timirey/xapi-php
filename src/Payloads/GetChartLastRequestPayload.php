<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;

/**
 * Class that contains payload for the getChartLastRequest command.
 */
class GetChartLastRequestPayload extends AbstractPayload
{
    /**
     * Constructor for getChartLastRequestPayload.
     *
     * @param ChartLastInfoRecord $chartLastInfoRecord Chart info parameters.
     */
    public function __construct(ChartLastInfoRecord $chartLastInfoRecord)
    {
        $this->arguments['info'] = $chartLastInfoRecord;
    }

    /**
     * @inheritdoc
     */
    public function getCommand(): string
    {
        return 'getChartLastRequest';
    }
}
