<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\Api\Actions;

use DateTime;
use Netresearch\Sdk\UniversalMessenger\Api\Actions\Newsletter;
use Netresearch\Sdk\UniversalMessenger\Exception\AuthenticationException;
use Netresearch\Sdk\UniversalMessenger\Exception\DetailedServiceException;
use Netresearch\Sdk\UniversalMessenger\Exception\ServiceException;
use Netresearch\Sdk\UniversalMessenger\Model\Collection\NewsletterChannelCollection;
use Netresearch\Sdk\UniversalMessenger\Model\NewsletterChannel;
use Netresearch\Sdk\UniversalMessenger\Model\NewsletterStatus;
use Netresearch\Sdk\UniversalMessenger\Test\Provider\NewsletterProvider;
use Netresearch\Sdk\UniversalMessenger\Test\TestCase;

/**
 * Class NewsletterTest.
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class NewsletterTest extends TestCase
{
    /**
     * Returns an instance of the newsletter API endpoint.
     *
     * @param string $responseJsonFile
     *
     * @return Newsletter
     *
     * @throws ServiceException
     */
    private function getNewsletterApi(string $responseJsonFile = ''): Newsletter
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->newsletter();
    }

    /**
     * @return string[][]
     */
    public static function channelsResponseDataProvider(): array
    {
        return [
            'Response' => [
                NewsletterProvider::channelsResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "channels" method.
     *
     * @dataProvider channelsResponseDataProvider
     *
     * @test
     *
     * @param string $responseJsonFile
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function newsletterChannels(string $responseJsonFile): void
    {
        $newsletterApi = $this->getNewsletterApi($responseJsonFile);
        $result        = $newsletterApi->channels();

        self::assertWebserviceUrl(
            'https://www.example.org/de.pinuts.cmsbs.restapi.Channels/index?umopen=TOTALLY-SECRET-API-KEY',
            $newsletterApi
        );

        self::assertHttpMethod('GET', $newsletterApi);
        self::assertCalledApiMethod('channels', $newsletterApi);
        self::assertInstanceOf(NewsletterChannelCollection::class, $result);
        self::assertContainsOnlyInstancesOf(NewsletterChannel::class, $result);

        foreach ($result as $newsletterChannel) {
            self::assertIsString($newsletterChannel->id);
            self::assertIsString($newsletterChannel->title);
            self::assertIsString($newsletterChannel->oid);
            self::assertIsBool($newsletterChannel->isPublic);
            self::assertIsBool($newsletterChannel->isVChannel);
            self::assertIsInt($newsletterChannel->estimatedCount);
            // self::assertIsArray($newsletterChannel->customAttributes);
        }
    }

    /**
     * @return string[][]
     */
    public static function statusResponseDataProvider(): array
    {
        return [
            'Response' => [
                NewsletterProvider::statusResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "status" method.
     *
     * @dataProvider statusResponseDataProvider
     *
     * @test
     *
     * @param string $responseJsonFile
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function newsletterStatus(string $responseJsonFile): void
    {
        $newsletterApi = $this->getNewsletterApi($responseJsonFile);
        $result        = $newsletterApi->status('FAKE-EVENT-ID');

        self::assertWebserviceUrl(
            'https://www.example.org/de.pinuts.cmsbs.restapi.NewsletterQueue/status/FAKE-EVENT-ID?umopen=TOTALLY-SECRET-API-KEY',
            $newsletterApi
        );

        self::assertHttpMethod('GET', $newsletterApi);
        self::assertCalledApiMethod('status', $newsletterApi);
        self::assertInstanceOf(NewsletterStatus::class, $result);

        self::assertIsString($result->eventId);
        self::assertIsString($result->oid);
        self::assertIsInt($result->sendState);
        self::assertIsNullOrInstanceOf(DateTime::class, $result->sendDate);
        self::assertIsInt($result->contacted);
        self::assertIsInt($result->notContacted);
        self::assertIsInt($result->counted);
        self::assertIsBool($result->inQueue);
        self::assertIsBool($result->isFailed);
        self::assertIsBool($result->isFinished);
        self::assertIsBool($result->isStopped);
    }
}
