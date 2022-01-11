<?php

namespace OwenVoke\CryptoScamDB\Api;

class Scam extends AbstractApi
{
    public function all(array $parameters = []): array
    {
        return $this->get('/scams', $parameters);
    }

    public function active(array $parameters = []): array
    {
        return $this->get('/actives', $parameters);
    }

    public function addresses(array $parameters = []): array
    {
        return $this->get('/addresses', $parameters);
    }

    public function allowed(array $parameters = []): array
    {
        return $this->get('/whitelist', $parameters);
    }

    public function blocked(array $parameters = []): array
    {
        return $this->get('/blacklist', $parameters);
    }

    public function featured(array $parameters = []): array
    {
        return $this->get('/featured', $parameters);
    }

    public function inactive(array $parameters = []): array
    {
        return $this->get('/inactives', $parameters);
    }

    public function ips(array $parameters = []): array
    {
        return $this->get('/ips', $parameters);
    }

    public function verified(array $parameters = []): array
    {
        return $this->get('/verified', $parameters);
    }
}
