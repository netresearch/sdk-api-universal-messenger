<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger;

use Netresearch\Sdk\UniversalMessenger\Api\Actions\EventFile;
use Netresearch\Sdk\UniversalMessenger\Api\Actions\Newsletter;
use Netresearch\Sdk\UniversalMessenger\Serializer\JsonSerializer;
use Netresearch\Sdk\UniversalMessenger\Serializer\XmlSerializer;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Provides methods to get classes for each type of API call.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Api
{
    /**
     * @var ClientInterface
     */
    private readonly ClientInterface $client;

    /**
     * @var RequestFactoryInterface
     */
    private readonly RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private readonly StreamFactoryInterface $streamFactory;

    /**
     * @var JsonSerializer
     */
    private readonly JsonSerializer $jsonSerializer;

    /**
     * The XML serializer instance.
     *
     * @var XmlSerializer
     */
    private readonly XmlSerializer $xmlSerializer;

    /**
     * @var UrlBuilder
     */
    private readonly UrlBuilder $urlBuilder;

    /**
     * Instance of the "newsletter" API for implementing lazy loading.
     *
     * @var Newsletter|null
     */
    private ?Newsletter $newsletterApi = null;

    /**
     * Instance of the "eventFile" API for implementing lazy loading.
     *
     * @var EventFile|null
     */
    private ?EventFile $eventFileApi = null;

    /**
     * @var string
     */
    private readonly string $apiKey;

    /**
     * Api constructor.
     *
     * @param ClientInterface         $client
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param JsonSerializer          $jsonSerializer
     * @param XmlSerializer           $xmlSerializer
     * @param UrlBuilder              $urlBuilder
     * @param string                  $apiKey
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        JsonSerializer $jsonSerializer,
        XmlSerializer $xmlSerializer,
        UrlBuilder $urlBuilder,
        string $apiKey,
    ) {
        $this->client         = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory  = $streamFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->xmlSerializer  = $xmlSerializer;
        $this->urlBuilder     = $urlBuilder;
        $this->apiKey         = $apiKey;
    }

    /**
     * Returns the "newsletter" API by lazy loading.
     *
     * @return Newsletter
     */
    public function newsletter(): Newsletter
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . Newsletter::PATH)
            ->setParams([
                'umopen' => $this->apiKey,
            ]);

        if (!($this->newsletterApi instanceof Newsletter)) {
            $this->newsletterApi = new Newsletter(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->jsonSerializer,
                $this->xmlSerializer,
                $this->urlBuilder
            );
        }

        return $this->newsletterApi;
    }

    /**
     * Returns the "eventFile" API by lazy loading.
     *
     * @return EventFile
     */
    public function eventFile(): EventFile
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . EventFile::PATH)
            ->setParams([
                'open' => $this->apiKey,
            ]);

        if (!($this->eventFileApi instanceof EventFile)) {
            $this->eventFileApi = new EventFile(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->jsonSerializer,
                $this->xmlSerializer,
                $this->urlBuilder
            );
        }

        return $this->eventFileApi;
    }
}
