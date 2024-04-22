<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Api;

use Closure;
use Netresearch\Sdk\UniversalMessenger\Exception\AuthenticationErrorException;
use Netresearch\Sdk\UniversalMessenger\Exception\AuthenticationException;
use Netresearch\Sdk\UniversalMessenger\Exception\DetailedErrorException;
use Netresearch\Sdk\UniversalMessenger\Exception\DetailedServiceException;
use Netresearch\Sdk\UniversalMessenger\Exception\ServiceException;
use Netresearch\Sdk\UniversalMessenger\Exception\ServiceExceptionFactory;
use Netresearch\Sdk\UniversalMessenger\Request\RequestInterface;
use Netresearch\Sdk\UniversalMessenger\Serializer\JsonSerializer;
use Netresearch\Sdk\UniversalMessenger\Serializer\XmlSerializer;
use Netresearch\Sdk\UniversalMessenger\UrlBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Throwable;

/**
 * An abstract class for each API endpoint, containing the methods, which performs
 * the actual request/response handling.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 *
 * @template TEntity
 * @template TEntityCollection
 */
abstract class AbstractApiEndpoint implements EndpointInterface
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @var RequestFactoryInterface
     */
    protected RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected StreamFactoryInterface $streamFactory;

    /**
     * The JSON serializer instance.
     *
     * @var JsonSerializer
     */
    protected JsonSerializer $jsonSerializer;

    /**
     * The XML serializer instance.
     *
     * @var XmlSerializer
     */
    protected XmlSerializer $xmlSerializer;

    /**
     * @var UrlBuilder
     */
    protected UrlBuilder $urlBuilder;

    /**
     * Constructor.
     *
     * @param ClientInterface         $client
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param JsonSerializer          $jsonSerializer
     * @param XmlSerializer           $xmlSerializer
     * @param UrlBuilder              $urlBuilder
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        JsonSerializer $jsonSerializer,
        XmlSerializer $xmlSerializer,
        UrlBuilder $urlBuilder
    ) {
        $this->client         = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory  = $streamFactory;
        $this->jsonSerializer = $jsonSerializer;
        $this->xmlSerializer  = $xmlSerializer;
        $this->urlBuilder     = $urlBuilder;
    }

    /**
     * Executes the given closure and returns the response result.
     *
     * @template T
     *
     * @param Closure(): T $requestClosure The closure to execute
     *
     * @return T
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function execute(Closure $requestClosure)
    {
        try {
            return $requestClosure();
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (ClientExceptionInterface $exception) {
            // Do not remove, a ClientExceptionInterface maybe thrown in the sendRequest() method
            throw ServiceExceptionFactory::createServiceException($exception);
        } catch (Throwable $exception) {
            throw ServiceExceptionFactory::create($exception);
        }
    }

    /**
     * Perform a GET request.
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     */
    protected function httpGet(): ResponseInterface
    {
        $request = $this->requestFactory
            ->createRequest('GET', (string) $this->urlBuilder);

        return $this->client->sendRequest($request);
    }

    /**
     * Returns a list of all entities.
     *
     * @param class-string<TEntity>           $className           The class name of the mapped response
     * @param class-string<TEntityCollection> $collectionClassName The collection class name of the
     *                                                             mapped response
     *
     * @return TEntityCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function findAllEntities(
        string $className,
        string $collectionClassName
    ) {
        $requestClosure = function () use ($className, $collectionClassName): mixed {
            $response = $this->httpGet();

            return $this->jsonSerializer
                ->decode((string) $response->getBody(), $className, $collectionClassName);
        };

        return $this->execute($requestClosure);
    }

    /**
     * Returns a single entity. The route must contain the ID of the entity to be processed.
     *
     * @param class-string<TEntity> $className The class name of the mapped response
     *
     * @return TEntity|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function findEntity(string $className)
    {
        $requestClosure = function () use ($className): mixed {
            $response = $this->httpGet();

            return $this->jsonSerializer
                ->decode((string) $response->getBody(), $className);
        };

        return $this->execute($requestClosure);
    }

    /**
     * Perform a POST request with XML data.
     *
     * @param RequestInterface $requestType The API request instance
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     * @throws ServiceException
     */
    protected function httpPostXml(RequestInterface $requestType): ResponseInterface
    {
        $encodedBody = $this->xmlSerializer->encode($requestType);

        if ($encodedBody === false) {
            throw new ServiceException('Failed to encode request into XML');
        }

        $request = $this->requestFactory
            ->createRequest('POST', (string) $this->urlBuilder)
            ->withHeader('Content-Type', 'text/xml; charset=UTF-8')
            ->withBody($this->streamFactory->createStream($encodedBody));

        return $this->client->sendRequest($request);
    }
}