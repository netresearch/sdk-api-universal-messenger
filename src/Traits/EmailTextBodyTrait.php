<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Traits;

use Netresearch\Sdk\UniversalMessenger\RequestBuilder\EventFile\CreateRequestBuilder;

/**
 * Trait that contains the methods for setting the TEXT content and attributes of the email.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
trait EmailTextBodyTrait
{
    /**
     * @param string|null $baseUrl
     * @param string|null $downloadUrl
     *
     * @return CreateRequestBuilder
     */
    public function setTextBodyBaseAndDownloadUrl(
        ?string $baseUrl,
        ?string $downloadUrl
    ): CreateRequestBuilder {
        $this->data['data']['text']['baseUrl']     = $baseUrl;
        $this->data['data']['text']['downloadUrl'] = $downloadUrl;

        return $this;
    }

    /**
     * @param string|null $charset
     *
     * @return CreateRequestBuilder
     */
    public function setTextBodyEncoding(
        ?string $charset
    ): CreateRequestBuilder {
        $this->data['data']['text']['charset'] = $charset;

        return $this;
    }

    /**
     * @param bool|null   $inline
     * @param string|null $content
     *
     * @return CreateRequestBuilder
     */
    public function setTextBodyContent(
        ?bool $inline,
        ?string $content
    ): CreateRequestBuilder {
        $this->data['data']['text']['inline']  = $inline;
        $this->data['data']['text']['content'] = $content;

        return $this;
    }

    /**
     * @param bool|null $linkTracking
     *
     * @return CreateRequestBuilder
     */
    public function setTextBodyTracking(
        ?bool $linkTracking
    ): CreateRequestBuilder {
        $this->data['data']['text']['linkTracking'] = $linkTracking;

        return $this;
    }

    /**
     * @param string|null $renderCallback
     *
     * @return CreateRequestBuilder
     */
    public function setTextBodyRenderCallback(
        ?string $renderCallback
    ): CreateRequestBuilder {
        $this->data['data']['text']['renderCallback'] = $renderCallback;

        return $this;
    }
}
