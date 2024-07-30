<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\KeepAliveStreamRecord;

/**
 * Class that contains the response of the fetchKeepAlive stream command.
 */
final readonly class FetchKeepAliveResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the FetchKeepAliveResponse class.
     *
     * @param  KeepAliveStreamRecord $keepAliveStreamRecord Keep alive record data.
     */
    public function __construct(public KeepAliveStreamRecord $keepAliveStreamRecord)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new KeepAliveStreamRecord(...$response));
    }
}
