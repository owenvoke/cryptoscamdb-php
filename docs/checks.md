# Checks API

[Back to the navigation](README.md)

Allows interacting with the Checks API.

### Retrieve the status of an address, IP, domain, or ENS name

```php
// Returns the status of a specific address, IP, domain, or ENS name
$response = $client->check()->status('etherscan.com');
// Returns the status of an address for a specific coin type
$response = $client->check()->status('0x25a51b3a7163352d4f32d0ed4a012b73fc32c08a', ['coin' => 'eth']);
```
