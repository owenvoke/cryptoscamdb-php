<?php

declare(strict_types=1);

use OwenVoke\CryptoScamDB\Api\Check;

beforeEach(fn () => $this->apiClass = Check::class);

it('should return a valid response for a domain', function (string $domain) {
    $api = $this->getApiMock();

    $expectedResponse = [
        'input' => $domain,
        'success' => true,
        'result' => [
            'status' => 'blocked',
            'type' => 'domain',
            'entries' => [
                // ...
            ],
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with("/check/{$domain}")
        ->willReturn($expectedResponse);

    expect($api->status($domain))->toBe($expectedResponse);
})->with([
    'xn--myetherwallt-leb.com',
    'myelherwallel.com',
]);
