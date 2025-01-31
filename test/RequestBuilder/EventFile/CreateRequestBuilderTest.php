<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Test\RequestBuilder\EventFile;

use JsonException;
use Netresearch\Sdk\UniversalMessenger\Exception\RequestValidatorException;
use Netresearch\Sdk\UniversalMessenger\RequestBuilder\EventFile\CreateRequestBuilder;
use Netresearch\Sdk\UniversalMessenger\Test\Provider\EventFileProvider;
use Netresearch\Sdk\UniversalMessenger\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class CreateRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public static function createRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(EventFileProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new person.
     *
     * @dataProvider createRequestDataProvider
     *
     * @test
     *
     * @param string $expectedXml
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function create(string $expectedXml): void
    {
        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setEventDetails('MY-CUSTOM-EVENT-ID', 'GROUP', true)
            ->setEventCreatedBy('john.doe', 'John Doe')
            ->setEventArchiveSaving(false, false)
            ->addTag('TAG-1')
            ->addTag('TAG-2')
            ->addTag('TAG-3')
            ->addChannel('CHANNEL-1')
            ->addChannel('CHANNEL-2')
            ->addVirtualChannel('V-CHANNEL-1')
            ->addVirtualChannel('V-CHANNEL-2')
            ->setPreview(
                'test@example.org',
                'service'
            )
            ->setQuery('language = "de"')
            ->setDate('2024-12-31', 'yyyy-MM-dd')
            ->setMailTo('jane.dow@example.org')
            ->setMessage('Mail message to sent')
            ->setEmailSubject('Subject')
            ->setEmailBaseAndDownloadUrl(
                'https://example.org/',
                'https://download.example.org/'
            )
            ->setEmailAdresses(
                'John Doe <john.doe@example.org>',
                'john.doe@example.org',
                'John Doe <john.doe@example.org>'
            )
            ->setEmailTracking('off')
            ->setEmailBodyType(false, true)
            ->setHtmlBodyBaseAndDownloadUrl(
                'https://html.example.org/',
                'https://html.download.example.org/',
                'https://html.proxy.example.org/'
            )
            ->setHtmlBodyEncoding('UTF-8')
            ->setHtmlBodyContent(
                false,
                <<<HTML

<html lang="en">
  <head>
    <title>Hello World!</title>
  </head>
  <body>
    <p>Hello World!</p>
  </body>
</html>

HTML
            )
            ->setHtmlBodyEmbedImages('all')
            ->setHtmlBodyTracking(false, false)
            ->setHtmlBodyRenderCallback('htmlCallbackMethod')
            ->setTextBodyBaseAndDownloadUrl(
                'https://plain.example.org/',
                'https://plain.download.example.org/'
            )
            ->setTextBodyEncoding('UTF-8')
            ->setTextBodyContent(true, 'Hello World!')
            ->setTextBodyTracking(false)
            ->setTextBodyRenderCallback('plainCallbackMethod')
            ->addFile(
                'FILE CONTENT',
                'inline',
                true,
                'logo.png'
            )
            ->addFile(
                null,
                null,
                false,
                'https://example.org/test.png'
            );

        $request    = $requestBuilder->create();
        $requestXml = $this->xmlSerializer->encode($request);

        self::assertSameXml($expectedXml, $requestXml);
    }
}
