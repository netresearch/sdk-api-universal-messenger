<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\Http\Formatter;

use Netresearch\Sdk\UniversalMessenger\Http\Formatter\RedactAuthorizationHeaderFormatter;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the RedactAuthorizationHeaderFormatter.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class RedactAuthorizationHeaderFormatterTest extends TestCase
{
    private const AUTHORIZATION_HEADER = 'Basic not-a-real-credential';

    #[Test]
    public function redactsAuthorizationHeaderWhenFormattingRequest(): void
    {
        $formatter = new RedactAuthorizationHeaderFormatter(null);

        $request = (new Request('GET', 'https://www.example.org/p'))
            ->withHeader('Authorization', self::AUTHORIZATION_HEADER);

        $formatted = $formatter->formatRequest($request);

        self::assertStringNotContainsString('not-a-real-credential', $formatted);
        self::assertStringContainsString('Authorization: ****', $formatted);
    }

    #[Test]
    public function leavesRequestWithoutAuthorizationHeaderUntouched(): void
    {
        $formatter = new RedactAuthorizationHeaderFormatter(null);

        $request = new Request('GET', 'https://www.example.org/p');

        $formatted = $formatter->formatRequest($request);

        self::assertStringContainsString('GET', $formatted);
        self::assertStringNotContainsString('Authorization', $formatted);
    }

    #[Test]
    public function doesNotMutateTheOriginalRequest(): void
    {
        $formatter = new RedactAuthorizationHeaderFormatter(null);

        $request = (new Request('GET', 'https://www.example.org/p'))
            ->withHeader('Authorization', self::AUTHORIZATION_HEADER);

        $formatter->formatRequest($request);

        self::assertSame(self::AUTHORIZATION_HEADER, $request->getHeaderLine('Authorization'));
    }

    #[Test]
    public function redactsAuthorizationHeaderWhenFormattingResponseForRequest(): void
    {
        $formatter = new RedactAuthorizationHeaderFormatter(null);

        $request = (new Request('GET', 'https://www.example.org/p'))
            ->withHeader('Authorization', self::AUTHORIZATION_HEADER);

        $formatted = $formatter->formatResponseForRequest(new Response(200), $request);

        self::assertStringNotContainsString('not-a-real-credential', $formatted);
    }
}
