<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Override;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getIbsHistory command.
 */
final class GetIbsHistoryPayload extends AbstractPayload
{
    /**
     * Constructor for GetIbsHistoryPayload.
     *
     * @param  DateTime $start Start time in milliseconds since epoch.
     * @param  DateTime $end   End time in milliseconds since epoch.
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->setParameters([
            'start' => DateTimeHelper::toMilliseconds($start),
            'end' => DateTimeHelper::toMilliseconds($end)
        ]);
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getIbsHistory';
    }
}
