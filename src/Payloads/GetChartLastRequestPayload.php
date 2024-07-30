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
        $this->setParameter('info', $chartLastInfoRecord);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getChartLastRequest';
    }
}
