<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger;

use Stringable;

/**
 * URL builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UrlBuilder implements Stringable
{
    /**
     * @var string
     */
    private string $baseUrl;

    /**
     * @var string[]
     */
    private array $paths = [];

    /**
     * @var array<string, string>
     */
    private array $parameters = [];

    /**
     * Resets the list of path parts.
     *
     * @return UrlBuilder
     */
    public function reset(): UrlBuilder
    {
        $this->paths = [];

        return $this;
    }

    /**
     * Sets the base URL.
     *
     * @param string $baseUrl
     *
     * @return UrlBuilder
     */
    public function setBase(string $baseUrl): UrlBuilder
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Adds a path part.
     *
     * @param string $path
     *
     * @return UrlBuilder
     */
    public function addPath(string $path): UrlBuilder
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * Returns the complete assembled URL.
     *
     * @return string
     */
    public function getFullUrl(): string
    {
        $url = $this->baseUrl . implode('', $this->paths);

        if ($this->parameters !== []) {
            $url .= '?' . http_build_query(array_filter($this->parameters));
        }

        return $url;
    }

    /**
     * @return array<string, string>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Sets a list of additional query parameters.
     *
     * @param array<string, string> $parameters
     *
     * @return UrlBuilder
     */
    public function setParams(array $parameters): UrlBuilder
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Adds an additional query parameter.
     *
     * @param string $key
     * @param string $value
     *
     * @return UrlBuilder
     */
    public function addParam(string $key, string $value): UrlBuilder
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFullUrl();
    }
}
