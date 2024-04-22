<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\RequestBuilder;

use Netresearch\Sdk\UniversalMessenger\Serializer\XmlSerializer;
use PHPUnit\Framework\TestCase;

/**
 * Class TestCase.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class RequestBuilderTestCase extends TestCase
{
    /**
     * @var XmlSerializer|null
     */
    protected ?XmlSerializer $xmlSerializer = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->xmlSerializer = new XmlSerializer();
    }

    /**
     * Asserts that two XML strings are the same.
     *
     * @param string $expectedXml
     * @param string $actualXml
     */
    protected static function assertSameXml(string $expectedXml, string $actualXml): void
    {
        self::assertSame($expectedXml, $actualXml);
    }
}
