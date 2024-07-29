<?php

namespace Timirey\XApi\Responses;

use DateTime;
use Override;
use Timirey\XApi\Helpers\DateTimeHelper;

/**
 * Class that contains the response of the getServerTime command.
 */
final readonly class GetServerTimeResponse extends AbstractResponse
{
    /**
     * @var DateTime Time in date time.
     */
    public DateTime $time;

    /**
     * Constructor for GetServerTimeResponse.
     *
     * @param  integer $time       Time in date time in ms.
     * @param  string  $timeString Time described in form set on server (local time of server).
     */
    public function __construct(int $time, public string $timeString)
    {
        $this->time = DateTimeHelper::fromMilliseconds($time);
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param array<string, mixed> $response Validated response data.
     * @return static Instance of the response.
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(...$response);
    }
}
