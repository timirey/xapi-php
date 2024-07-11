<?php

use Timirey\XApi\Payloads\PingStreamPayload;
use Timirey\XApi\Tests\Commands\Traits\StreamClientMockeryTrait;

uses(StreamClientMockeryTrait::class);

beforeEach(function () {
    $this->mockStreamClient();
});

afterEach(function () {
    Mockery::close();
});

test('ping stream command', function () {
    $payload = new PingStreamPayload('streamSessionId');

    $this->streamSocket->shouldReceive('send')
        ->once()
        ->with($payload->toJson());

    $this->streamClient->ping();
});
