<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\Provider;

/**
 * Class EventFileProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class EventFileProvider
{
    /**
     * @return string
     */
    public static function createRequest(): string
    {
        return __DIR__ . '/_files/Request/EventFile/create.xml';
    }
}
