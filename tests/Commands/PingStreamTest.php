<?php

use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockClient();
});

afterEach(function () {
    Mockery::close();
});

test('ping stream command', function (): void {
    $payload = new PingStreamPayload('streamSessionId');

    $this->socket->shouldReceive('send')
        ->once()
        ->with($payload->toJson());

    $this->client->ping();
});
