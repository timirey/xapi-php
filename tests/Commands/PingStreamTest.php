<?php

use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Tests\Commands\Traits\ClientMockeryTrait;

uses(ClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('ping stream command', function (): void {
    $payload = new PingStreamPayload('streamSessionId');

    $this->stream->shouldReceive('send')
        ->once()
        ->with($payload->toJson());

    $this->client->pingStream();
});
