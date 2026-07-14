<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Http\Formatter;

use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * A full HTTP message formatter that redacts the "Authorization" request header
 * before formatting, so the HTTP basic authentication credentials are never
 * written to the log.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
final class RedactAuthorizationHeaderFormatter extends FullHttpMessageFormatter
{
    /**
     * Formats a request, with the "Authorization" header redacted.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function formatRequest(RequestInterface $request): string
    {
        return parent::formatRequest($this->redact($request));
    }

    /**
     * Formats a response in context of its request, with the request's
     * "Authorization" header redacted.
     *
     * @param ResponseInterface $response
     * @param RequestInterface  $request
     *
     * @return string
     */
    public function formatResponseForRequest(ResponseInterface $response, RequestInterface $request): string
    {
        return parent::formatResponseForRequest($response, $this->redact($request));
    }

    /**
     * Returns a clone of the request with a redacted "Authorization" header.
     *
     * @param RequestInterface $request
     *
     * @return RequestInterface
     */
    private function redact(RequestInterface $request): RequestInterface
    {
        if ($request->hasHeader('Authorization')) {
            return $request->withHeader('Authorization', '****');
        }

        return $request;
    }
}
