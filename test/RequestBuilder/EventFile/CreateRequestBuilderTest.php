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
use Netresearch\Sdk\UniversalMessenger\Request\Event;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\File;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\HtmlText;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\PlainText;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Date;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview\BaseEntry;
use Netresearch\Sdk\UniversalMessenger\RequestBuilder\EventFile\CreateRequestBuilder;
use Netresearch\Sdk\UniversalMessenger\Test\Provider\EventFileProvider;
use Netresearch\Sdk\UniversalMessenger\Test\RequestBuilder\RequestBuilderTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

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
     * @param string $expectedXml
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    #[DataProvider('createRequestDataProvider')]
    #[Test]
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

        $this->assertRequestGetters($request);

        self::assertSameXml($expectedXml, $requestXml);
    }

    /**
     * Pins that every getter on the built request mirrors what was set
     * above. Nothing else in this repo constructs or reads these getters
     * (the XML serializer reads the same private properties directly via
     * reflection attributes, bypassing them entirely), so without this,
     * a getter mismatching its own property (e.g. a rename that breaks
     * getTags()/getVChannels()/getFiles(), whose method name already
     * diverges from the backing property name) would go undetected by
     * this suite.
     */
    private function assertRequestGetters(Event $request): void
    {
        self::assertSame('MY-CUSTOM-EVENT-ID', $request->getId());
        self::assertSame('GROUP', $request->getNewsletterGroup());
        self::assertTrue($request->getSkipUsedIDs());
        self::assertSame('john.doe', $request->getCreatedBy());
        self::assertSame('John Doe', $request->getCreatedByDisplayName());
        self::assertFalse($request->getArchive());
        self::assertFalse($request->getArchiveSkipped());
        self::assertSame(['TAG-1', 'TAG-2', 'TAG-3'], $request->getTags());

        $destination = $request->getDestination();
        self::assertInstanceOf(Destination::class, $destination);
        self::assertSame(['CHANNEL-1', 'CHANNEL-2'], $destination->getChannels());
        self::assertSame(['V-CHANNEL-1', 'V-CHANNEL-2'], $destination->getVChannels());
        self::assertSame('language = "de"', $destination->getQuery());

        $preview = $destination->getPreview();
        self::assertInstanceOf(Preview::class, $preview);
        self::assertSame('service', $preview->getService());
        self::assertInstanceOf(BaseEntry::class, $preview->getBaseEntry());
        self::assertSame('test@example.org', $preview->getBaseEntry()->getEmail());

        $date = $request->getDate();
        self::assertInstanceOf(Date::class, $date);
        self::assertSame('2024-12-31', $date->getValue());
        self::assertSame('yyyy-MM-dd', $date->getFormat());

        $data = $request->getData();
        self::assertInstanceOf(Data::class, $data);
        self::assertSame('jane.dow@example.org', $data->getMailto());
        self::assertSame('Mail message to sent', $data->getMessage());

        $email = $data->getEmail();
        self::assertInstanceOf(Email::class, $email);
        self::assertSame('Subject', $email->getSubject());
        self::assertSame('https://example.org/', $email->getBaseUrl());
        self::assertSame('https://download.example.org/', $email->getDownloadUrl());
        self::assertSame('John Doe <john.doe@example.org>', $email->getSender());
        self::assertSame('john.doe@example.org', $email->getReplyto());
        self::assertSame('John Doe <john.doe@example.org>', $email->getEnvelopeFrom());
        self::assertSame('off', $email->getTrackingMode());
        self::assertFalse($email->getObeyPreferHtml());
        self::assertTrue($email->getSendBothParts());

        $htmltext = $email->getHtmltext();
        self::assertInstanceOf(HtmlText::class, $htmltext);
        self::assertSame('https://html.example.org/', $htmltext->getBaseUrl());
        self::assertSame('https://html.download.example.org/', $htmltext->getDownloadUrl());
        self::assertSame('https://html.proxy.example.org/', $htmltext->getRestProxyUrl());
        self::assertSame('UTF-8', $htmltext->getCharset());
        self::assertFalse($htmltext->getInline());
        self::assertStringContainsString('Hello World!', (string) $htmltext->getContent());
        self::assertSame('all', $htmltext->getEmbedImages());
        self::assertFalse($htmltext->getLinkTracking());
        self::assertFalse($htmltext->getViewTracking());
        self::assertSame('htmlCallbackMethod', $htmltext->getRenderCallback());

        $plaintext = $email->getPlaintext();
        self::assertInstanceOf(PlainText::class, $plaintext);
        self::assertSame('https://plain.example.org/', $plaintext->getBaseUrl());
        self::assertSame('https://plain.download.example.org/', $plaintext->getDownloadUrl());
        self::assertSame('UTF-8', $plaintext->getCharset());
        self::assertTrue($plaintext->getInline());
        self::assertSame('Hello World!', $plaintext->getContent());
        self::assertFalse($plaintext->getLinkTracking());
        self::assertSame('plainCallbackMethod', $plaintext->getRenderCallback());

        $files = $email->getFiles();
        self::assertCount(2, $files);
        self::assertContainsOnlyInstancesOf(File::class, $files);
        self::assertSame('FILE CONTENT', $files[0]->getContent());
        self::assertSame('inline', $files[0]->getDisposition());
        self::assertTrue($files[0]->getInline());
        self::assertSame('logo.png', $files[0]->getName());
        self::assertNull($files[1]->getContent());
        self::assertNull($files[1]->getDisposition());
        self::assertFalse($files[1]->getInline());
        self::assertSame('https://example.org/test.png', $files[1]->getName());
    }
}
