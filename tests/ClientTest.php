<?php

declare(strict_types=1);

use OwenVoke\CryptoScamDB\Api\Check;
use OwenVoke\CryptoScamDB\Api\Scam;
use OwenVoke\CryptoScamDB\Client;

it('gets instances from the client', function () {
    $client = new Client();

    // Retrieves Check instance
    expect($client->check())->toBeInstanceOf(Check::class);
    expect($client->checks())->toBeInstanceOf(Check::class);

    // Retrieves Scam instance
    expect($client->scam())->toBeInstanceOf(Scam::class);
    expect($client->scams())->toBeInstanceOf(Scam::class);
});
