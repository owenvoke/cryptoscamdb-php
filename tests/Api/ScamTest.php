<?php

declare(strict_types=1);

use OwenVoke\CryptoScamDB\Api\Scam;

beforeEach(fn () => $this->apiClass = Scam::class);

it('should return a list of scams', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            [
                'id' => '0efd58',
                'name' => 'xn--myetherwallt-leb.com',
                'url' => 'http://xn--myetherwallt-leb.com',
                'path' => '/*',
                'category' => 'Phishing',
                'subcategory' => 'MyEtherWallet',
                'description' => 'Google reports site as insecure',
                'reporter' => 'CryptoScamDB',
            ],
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/scams')
        ->willReturn($expectedResponse);

    expect($api->all())->toBe($expectedResponse);
});

it('should return a list of active scams', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/actives')
        ->willReturn($expectedResponse);

    expect($api->active())->toBe($expectedResponse);
});

it('should return a list of addresses', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            '0x0000000012ba45c32e4380a42ee524fe30502943' => [
                'id' => 'a73833',
                'name' => 'eth.ug',
                'type' => 'scam',
                'url' => 'http://eth.ug',
                // ...
            ],
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/addresses')
        ->willReturn($expectedResponse);

    expect($api->addresses())->toBe($expectedResponse);
});

it('should return a list of allowed domains', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            'mycrypto.com',
            // ...
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/whitelist')
        ->willReturn($expectedResponse);

    expect($api->allowed())->toBe($expectedResponse);
});

it('should return a list of blocked domains', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            'xn--myetherwallt-leb.com',
            // ...
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/blacklist')
        ->willReturn($expectedResponse);

    expect($api->blocked())->toBe($expectedResponse);
});

it('should return a list of featured domains', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            [
                'id' => '635b2f',
                'name' => 'MyCrypto',
                'description' => 'MyCrypto is a free, open-source interface for interacting with the blockchain',
                'url' => 'https://mycrypto.com',
            ],
            // ...
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/featured')
        ->willReturn($expectedResponse);

    expect($api->featured())->toBe($expectedResponse);
});

it('should return a list of inactive scams', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/inactives')
        ->willReturn($expectedResponse);

    expect($api->inactive())->toBe($expectedResponse);
});

it('should return a list of IPs', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/ips')
        ->willReturn($expectedResponse);

    expect($api->ips())->toBe($expectedResponse);
});

it('should return a list of verified (non-malicious) entries', function () {
    $api = $this->getApiMock();

    $expectedResponse = [
        'success' => true,
        'result' => [
            [
                'id' => '635b2f',
                'name' => 'MyCrypto',
                'featured' => 1,
                'description' => 'MyCrypto is a free, open-source interface for interacting with the blockchain',
                'address' => '0x4bbeEB066eD09B7AEd07bF39EEe0460DFa261520',
                'coin' => 'ETH',
            ],
            // ...
        ],
    ];

    $api->expects($this->once())
        ->method('get')
        ->with('/verified')
        ->willReturn($expectedResponse);

    expect($api->verified())->toBe($expectedResponse);
});
