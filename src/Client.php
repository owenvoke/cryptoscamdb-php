<?php

declare(strict_types=1);

namespace OwenVoke\CryptoScamDB;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use OwenVoke\CryptoScamDB\Api\AbstractApi;
use OwenVoke\CryptoScamDB\Api\Check;
use OwenVoke\CryptoScamDB\Exception\BadMethodCallException;
use OwenVoke\CryptoScamDB\Exception\InvalidArgumentException;
use OwenVoke\CryptoScamDB\HttpClient\Builder;
use OwenVoke\CryptoScamDB\HttpClient\Plugin\Authentication;
use OwenVoke\CryptoScamDB\HttpClient\Plugin\PathPrepend;
use Psr\Http\Client\ClientInterface;

/**
 * @method Check check()
 * @method Check checks()
 */
final class Client
{
    public const AUTH_ACCESS_TOKEN = 'access_token_header';

    private Builder $httpClientBuilder;

    public function __construct(Builder $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.cryptoscamdb.org')));
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'cryptoscamdb-php (https://github.com/owenvoke/cryptoscamdb-php)',
        ]));

        $builder->addHeaderValue('Accept', 'application/json');
        $builder->addPlugin(new PathPrepend('/v1'));
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        switch ($name) {
            case 'check':
            case 'checks':
                return new Check($this);

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }
    }

    public function authenticate(string $tokenOrLogin, ?string $password = null, ?string $authMethod = null): void
    {
        if (null === $password && null === $authMethod) {
            throw new InvalidArgumentException('You need to specify authentication method!');
        }

        if (null === $authMethod && $password === self::AUTH_ACCESS_TOKEN) {
            $authMethod = $password;
            $password = null;
        }

        $this->getHttpClientBuilder()->removePlugin(Authentication::class);
        $this->getHttpClientBuilder()->addPlugin(new Authentication($tokenOrLogin, $password, $authMethod));
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name), $e->getCode(), $e);
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    public function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
