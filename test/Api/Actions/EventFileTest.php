<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\Api\Actions;

use Netresearch\Sdk\UniversalMessenger\Api\Actions\EventFile;
use Netresearch\Sdk\UniversalMessenger\Exception\ServiceException;
use Netresearch\Sdk\UniversalMessenger\Request\Event;
use Netresearch\Sdk\UniversalMessenger\Test\TestCase;

/**
 * Class EventFileTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class EventFileTest extends TestCase
{
    /**
     * Returns an instance of the eventFile API endpoint.
     *
     * @return EventFile
     *
     * @throws ServiceException
     */
    private function getEventFileApi(): EventFile
    {
        $serviceFactoryMock = $this->getServiceFactoryMock();

        return $serviceFactoryMock
            ->api()
            ->eventFile();
    }

    /**
     * Tests "eventFile" method.
     *
     * @test
     */
    public function eventFile(): void
    {
        $eventFileApi = $this->getEventFileApi();
        $result       = $eventFileApi->event(new Event());

        self::assertWebserviceUrl(
            'https://www.example.org/de.pinuts.cmsbs.restsend.EventFile/?open=TOTALLY-SECRET-API-KEY',
            $eventFileApi
        );

        self::assertHttpMethod('POST', $eventFileApi);
        self::assertCalledApiMethod('event', $eventFileApi);
        self::assertTrue($result);
    }
}
