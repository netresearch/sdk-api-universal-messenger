# Error handling
The exceptions thrown by the SDK will always be of type `\Netresearch\Sdk\UniversalMessenger\Exception\ServiceException`.
Subclasses of `ServiceException` may be used to describe the kind of error that occurred.

A `\Netresearch\Sdk\UniversalMessenger\Exception\DetailedServiceException` indicates that the exception holds a
human-readable error message suitable for display to the end-user.

Surround each API call with a try/catch block to allow proper exception handling.

```php
try {
    // Create request builder instance
    $requestBuilder = ...

    // Perform request
    $response = $apiClient
        ->api()
        -> ...

    // Process response
    ...
} catch (\Netresearch\Sdk\UniversalMessenger\Exception\ServiceException $exception) {
    // Handle possible errors
}
```
