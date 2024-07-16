<?php

require_once 'vendor/autoload.php';

use Timirey\XApi\Client;
use Timirey\XApi\Enums\Host;
use Timirey\XApi\Enums\StreamHost;
use Timirey\XApi\Responses\Data\TickStreamRecord;
use Timirey\XApi\Responses\LoginResponse;
use Timirey\XApi\StreamClient;

/**
 * @var Client
 */
$client = new Client(userId: 16375747, password: '927810X7mama', host: Host::DEMO);

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
    host: StreamHost::DEMO,
);

// It is better practice to handle subscriptions through a separate worker, ex.: Laravel cron job.
$streamClient->getCandles(
    symbol: 'EURUSD',
    callback: static function ($response): void {
        print_r($response);
    }
);

// Unreachable code.
