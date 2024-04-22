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
 * Class NewsletterProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class NewsletterProvider
{
    /**
     * @return string
     */
    public static function channelsResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Newsletter/channels.json';
    }

    /**
     * @return string
     */
    public static function statusResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Newsletter/status.json';
    }
}
