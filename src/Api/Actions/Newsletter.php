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
use Netresearch\Sdk\UniversalMessenger\Model\Collection\NewsletterChannelCollection;
use Netresearch\Sdk\UniversalMessenger\Model\NewsletterChannel;
use Netresearch\Sdk\UniversalMessenger\Model\NewsletterStatus;

/**
 * The /newsletter endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class Newsletter extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'de.pinuts.cmsbs.restapi.';

    /**
     * Returns a list of all newsletter channels.
     *
     * GET https://<BASE-URL>/de.pinuts.cmsbs.restapi.Channels/index?umopen=
     *
     * @return NewsletterChannelCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function channels(): NewsletterChannelCollection
    {
        $this->urlBuilder
            ->addPath('Channels/index');

        return $this->findAllEntities(
            NewsletterChannel::class,
            NewsletterChannelCollection::class,
            __FUNCTION__
        );
    }

    /**
     * Returns the status of a newsletter delivery.
     *
     * GET https://<BASE-URL>/de.pinuts.cmsbs.restapi.NewsletterQueue/status/<eventId>?umopen=
     *
     * @param string $eventId
     *
     * @return NewsletterStatus
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function status(string $eventId): NewsletterStatus
    {
        $this->urlBuilder
            ->addPath('NewsletterQueue/status/')
            ->addPath($eventId);

        return $this->findEntity(
            NewsletterStatus::class,
            __FUNCTION__
        );
    }
}
