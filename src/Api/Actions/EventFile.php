<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Api\Actions;

use Netresearch\Sdk\UniversalMessenger\Api\AbstractApiEndpoint;
use Netresearch\Sdk\UniversalMessenger\Exception\AuthenticationException;
use Netresearch\Sdk\UniversalMessenger\Exception\DetailedServiceException;
use Netresearch\Sdk\UniversalMessenger\Exception\ServiceException;
use Netresearch\Sdk\UniversalMessenger\Request\Event as EventRequest;

/**
 * The /eventFile endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class EventFile extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'de.pinuts.cmsbs.restsend.EventFile/';

    /**
     * Posts a XML event file request.
     *
     * GET https://<BASE-URL>/de.pinuts.cmsbs.restsend.EventFile/?open=
     *
     * @param EventRequest $request
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function event(EventRequest $request): bool
    {
        return $this->httpPostXml($request)->getStatusCode() < 300;
    }
}
