<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use Throwable;

/**
 * A service exception factory to create specific exception instances.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ServiceExceptionFactory
{
    /**
     * Create a service exception.
     *
     * @param Throwable $exception
     *
     * @return ServiceException
     */
    public static function create(Throwable $exception): ServiceException
    {
        return new ServiceException($exception->getMessage(), $exception->getCode(), $exception);
    }

    /**
     * Create a HTTP client exception.
     *
     * @param ClientExceptionInterface $exception
     *
     * @return ServiceException
     */
    public static function createServiceException(ClientExceptionInterface $exception): ServiceException
    {
        return self::create($exception);
    }

    /**
     * Create a detailed service exception.
     *
     * @param Throwable $exception
     *
     * @return DetailedServiceException
     */
    public static function createDetailedServiceException(Throwable $exception): DetailedServiceException
    {
        return new DetailedServiceException($exception->getMessage(), $exception->getCode(), $exception);
    }

    /**
     * Create an authentication exception.
     *
     * @param Throwable $exception
     *
     * @return AuthenticationException
     */
    public static function createAuthenticationException(Throwable $exception): AuthenticationException
    {
        return new AuthenticationException($exception->getMessage(), $exception->getCode(), $exception);
    }
}
