# Usage
The usage of the SDK is pretty straight forward. To perform a request, use one of the provided request
builders to create a valid request object. This allows you the using of the SDK without having to know the 
underlying API. Use the request object together with the desired API endpoint method to call the interface.

## Create an API instance
First of all you need to create a new API instance. You pass the base API URL together with the API key
and secret to this instance.

```php
// Create API client instance
$apiClient = new \Netresearch\Sdk\UniversalMessenger\UniversalMessenger(
    new \Psr\Log\NullLogger(),
    '<API-BASE-URL>',
    '<API-KEY>',
    '<API-SECRET>'
);
```

The API uses HTTP basic authentication: the public API key is sent as the username and the secret key as
the password. Create an API key in the Universal Messenger backend to obtain both values.

The client instance provides the `api()` method to access the implemented API endpoints.


## Class map
Optionally, an additional class map can be passed to the constructor of the API client as the fifth parameter.
By default, the JSON response from the API is mapped to the appropriate models in the SDK. By passing an alternative
mapping, the returned class structure can be adapted to the needs. The class to be overwritten in the SDK is
specified as the key, and the name of the new class is expected as the value.

```php
// Class map <source => target>
$classMap = [
    \Netresearch\Sdk\UniversalMessenger\Model\Tags::class     => \Vendor\Model\Tags::class,
    \Netresearch\Sdk\UniversalMessenger\Model\Tags\Tag::class => \Vendor\Model\Tag::class,
];

$apiClient = new \Netresearch\Sdk\UniversalMessenger\UniversalMessenger(
    new \Psr\Log\NullLogger(),
    '<API-BASE-URL>',
    '<API-KEY>',
    '<API-SECRET>',
    $classMap
);
```
