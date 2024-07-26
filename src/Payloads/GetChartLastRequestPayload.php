<?php

namespace Timirey\XApi\Payloads;

use Override;
use Timirey\XApi\Payloads\Data\ChartLastInfoRecord;

/**
 * Class that contains payload for the getChartLastRequest command.
 */
final class GetChartLastRequestPayload extends AbstractPayload
{
    /**
     * Constructor for GetChartLastRequestPayload.
     *
     * @param  ChartLastInfoRecord $chartLastInfoRecord Chart last info parameters.
     */
    public function __construct(ChartLastInfoRecord $chartLastInfoRecord)
    {
        $this->parameters['info'] = $chartLastInfoRecord;
    }

    /**
     * Get the command.
     *
     * @return string Command name.
     */
    #[Override]
    public function getCommand(): string
    {
        return 'getChartLastRequest';
    }
}
