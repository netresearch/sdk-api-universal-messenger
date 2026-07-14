[![Latest version](https://img.shields.io/github/v/release/netresearch/sdk-api-universal-messenger?sort=semver)](https://github.com/netresearch/sdk-api-universal-messenger/releases/latest)
[![License](https://img.shields.io/github/license/netresearch/sdk-api-universal-messenger)](https://github.com/netresearch/sdk-api-universal-messenger/blob/main/LICENSE)
[![CI](https://github.com/netresearch/sdk-api-universal-messenger/actions/workflows/ci.yml/badge.svg)](https://github.com/netresearch/sdk-api-universal-messenger/actions/workflows/ci.yml)


# Universal Messenger API
The documentation for all requests can be found at [Universal Messenger API Documentation](doc/Developer_de_UM_7-64.pdf).

The Universal Messenger API SDK package offers an interface to the *Universal Messenger* interface.
The SDK currently implements only the endpoints and data structures that were required at the time of development.

## Table of contents
- [Requirements & Installation](doc/Requirements.md)
- [Basic usage & Limitations](doc/Basic.md)
- [Endpoints](doc/Endpoints.md)
- [Error handling](doc/ErrorHandling.md)

## Compatibility
The Universal Messenger REST API is not versioned on the client side. The SDK addresses fixed endpoints,
and the behaviour — most notably the authentication scheme — depends on the Universal Messenger server
version that is deployed. Authentication is therefore what distinguishes the server generations, and the
SDK major version reflects the supported era:

| SDK      | Authentication                                                             | Universal Messenger server |
|:---------|:---------------------------------------------------------------------------|:---------------------------|
| `^2.0`   | API token via the `umopen`/`open` query parameter (`cmsbs.open`)           | UM before 7.56             |
| `^3.0`   | API key (public key + secret) via HTTP basic authentication                | UM 7.56.0 and later        |

Pin the SDK major version to match your Universal Messenger server. The `umopen`/`open` token is deprecated
since UM 7.41 and, while it still works transitionally, will be removed; from UM 7.56.0 an API key is
required. See section *API-Schlüssel* of the [developer documentation](doc/Developer_de_UM_7-64.pdf).
