<?php

namespace Timirey\XApi\Payloads;

use DateTime;
use Override;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains payload for the getNews command.
 */
final class GetNewsPayload extends AbstractPayload
{
    /**
     * Constructor for GetNewsPayload.
     *
     * @param DateTime $start Start time in milliseconds since epoch.
     * @param DateTime $end   End time in milliseconds since epoch.
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
        return 'getNews';
    }
}
