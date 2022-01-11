<?php

namespace OwenVoke\CryptoScamDB\Api;

class Check extends AbstractApi
{
    /** @param  string  $identifier An address, IP, domain, or ENS name */
    public function status(string $identifier, array $parameters = []): array
    {
        return $this->get("/check/{$identifier}", $parameters);
    }
}
