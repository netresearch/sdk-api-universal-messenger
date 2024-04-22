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
 * Trait that contains the methods for setting the HTML content and attributes of the email.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
trait EmailHtmlBodyTrait
{
    /**
     * @param string|null $baseUrl
     * @param string|null $downloadUrl
     * @param string|null $restProxyUrl
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyBaseAndDownloadUrl(
        ?string $baseUrl,
        ?string $downloadUrl,
        ?string $restProxyUrl
    ): CreateRequestBuilder {
        $this->data['data']['html']['baseUrl']      = $baseUrl;
        $this->data['data']['html']['downloadUrl']  = $downloadUrl;
        $this->data['data']['html']['restProxyUrl'] = $restProxyUrl;

        return $this;
    }

    /**
     * @param string|null $charset
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyEncoding(
        ?string $charset
    ): CreateRequestBuilder {
        $this->data['data']['html']['charset'] = $charset;

        return $this;
    }

    /**
     * @param bool|null   $inline
     * @param string|null $content
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyContent(
        ?bool $inline,
        ?string $content
    ): CreateRequestBuilder {
        $this->data['data']['html']['inline']  = $inline;
        $this->data['data']['html']['content'] = $content;

        return $this;
    }

    /**
     * @param string|null $embedImages
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyEmbedImages(
        ?string $embedImages
    ): CreateRequestBuilder {
        $this->data['data']['html']['embedImages'] = $embedImages;

        return $this;
    }

    /**
     * @param bool|null $linkTracking
     * @param bool|null $viewTracking
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyTracking(
        ?bool $linkTracking,
        ?bool $viewTracking
    ): CreateRequestBuilder {
        $this->data['data']['html']['linkTracking'] = $linkTracking;
        $this->data['data']['html']['viewTracking'] = $viewTracking;

        return $this;
    }

    /**
     * @param string|null $renderCallback
     *
     * @return CreateRequestBuilder
     */
    public function setHtmlBodyRenderCallback(
        ?string $renderCallback
    ): CreateRequestBuilder {
        $this->data['data']['html']['renderCallback'] = $renderCallback;

        return $this;
    }
}
