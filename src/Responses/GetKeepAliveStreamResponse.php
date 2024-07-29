<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\KeepAliveStreamRecord;

/**
 * Class that contains the response of the getKeepAlive stream command.
 */
final readonly class GetKeepAliveStreamResponse extends AbstractStreamResponse
{
    /**
     * Constructor for the GetKeepAliveStreamResponse class.
     *
     * @param  KeepAliveStreamRecord $keepAliveStreamRecord Keep alive record data.
     */
    public function __construct(public KeepAliveStreamRecord $keepAliveStreamRecord)
    {
    }

    /**
     * Create an instance from the validated data.
     *
     * @param  array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(new KeepAliveStreamRecord(...$response));
    }
}
