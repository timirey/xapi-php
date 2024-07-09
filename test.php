<?php

use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Responses\Data\TickStreamRecord;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\StreamClient;

/**
 * @var Client
 */
$client = new Client(userId: 123456789, password: 'password', host: Host::DEMO);

/**
 * @var LoginResponse $loginResponse
 */
$loginResponse = $client->login();

/**
 * @var string $streamSessionId
 */
$streamSessionId = $loginResponse->streamSessionId;

/**
 * @var StreamClient
 */
$streamClient = new StreamClient(
    streamSessionId: $streamSessionId,
    host: StreamHost::DEMO
);

// It is better practice to handle subscriptions through a separate worker, ex.: Laravel cron job.
$streamClient->getTickPrices(
    symbol: 'EURUSD',
    callback: static function (TickStreamRecord $tickStreamRecord): void {
        print_r($tickStreamRecord);
    }
);

// Unreachable code.
