<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Override;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getTradesHistory command.
 */
final class GetTradesHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetTradesHistoryPayload.
     *
     * @param DateTime $start Start time for trade history retrieval.
     * @param DateTime $end   End time for trade history retrieval.
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->setParameters([
            'start' => DateTimeHelper::toMilliseconds($start),
            'end' => DateTimeHelper::toMilliseconds($end),
        ]);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getTradesHistory';
    }
}
