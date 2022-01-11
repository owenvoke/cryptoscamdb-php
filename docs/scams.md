# Scams API

[Back to the navigation](README.md)

Allows interacting with the Scams API.

### Returns a list of the scams currently tracked by CryptoScamDB

```php
$response = $client->scams()->all();
```

### Returns a list of active scams

```php
$response = $client->scams()->active();
```

### Returns a list of addresses and their associated malicious entries

```php
$response = $client->scams()->addresses();
```

### Returns a list of allowed domains

```php
$response = $client->scams()->allowed();
```

### Returns a list of blocked domains

```php
$response = $client->scams()->blocked();
```

### Returns a list of featured verified entries

```php
$response = $client->scams()->featured();
```

### Returns a list of inactive scams

```php
$response = $client->scams()->inactive();
```

### Returns a list of IPs and their associated malicious entries

```php
$response = $client->scams()->ips();
```

### Returns a list of the entries that were verified (non-malicious) by the CryptoScamDB team

```php
$response = $client->scams()->verified();
```
