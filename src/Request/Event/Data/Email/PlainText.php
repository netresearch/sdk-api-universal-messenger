<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use MagicSunday\XmlMapper\Annotation\XmlNodeValue;
use MagicSunday\XmlSerializable;

/**
 * The plaintext element encloses the area describing the text email.
 * The interpretation of the content is marked using the inline attribute.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class PlainText implements XmlSerializable
{
    /**
     * TRUE if the text to be sent is directly specified as the content of the plaintext element.
     * FALSE if the text to be sent is to be read from the file specified with an absolute path or the URL.
     * "none" if no text email is to be sent.
     *
     * @var bool|null
     */
    #[XmlAttribute]
    private ?bool $inline = null;

    /**
     * Specification of the encoding.
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $charset = null;

    /**
     * URL that precedes the relative links.
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $baseUrl = null;

    /**
     * URL from which referenced files are downloaded. If this attribute is not specified,
     * then the baseUrl attribute from the email element is used instead.
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $downloadUrl = null;

    /**
     * FALSE if click tracking should be deactivated for this newsletter.
     *
     * @var bool|null
     */
    #[XmlAttribute]
    private ?bool $linkTracking = null;

    /**
     * Function name of a CSE callback to be called when the newsletter is rendered.
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $renderCallback = null;

    /**
     * The plain text to send.
     *
     * @var string|null
     */
    #[XmlNodeValue]
    private ?string $content = null;

    /**
     * @param bool|null $inline
     *
     * @return PlainText
     */
    public function setInline(?bool $inline): PlainText
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * @return bool|null TRUE if the text is given directly as the element content, FALSE if it should be read from the file/URL
     */
    public function getInline(): ?bool
    {
        return $this->inline;
    }

    /**
     * @param string|null $charset
     *
     * @return PlainText
     */
    public function setCharset(?string $charset): PlainText
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * @return string|null The encoding
     */
    public function getCharset(): ?string
    {
        return $this->charset;
    }

    /**
     * @param string|null $baseUrl
     *
     * @return PlainText
     */
    public function setBaseUrl(?string $baseUrl): PlainText
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @return string|null The URL that precedes the relative links
     */
    public function getBaseUrl(): ?string
    {
        return $this->baseUrl;
    }

    /**
     * @param string|null $downloadUrl
     *
     * @return PlainText
     */
    public function setDownloadUrl(?string $downloadUrl): PlainText
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    /**
     * @return string|null The URL from which referenced files are downloaded
     */
    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    /**
     * @param bool|null $linkTracking
     *
     * @return PlainText
     */
    public function setLinkTracking(?bool $linkTracking): PlainText
    {
        $this->linkTracking = $linkTracking;

        return $this;
    }

    /**
     * @return bool|null FALSE if click tracking should be deactivated for this newsletter
     */
    public function getLinkTracking(): ?bool
    {
        return $this->linkTracking;
    }

    /**
     * @param string|null $renderCallback
     *
     * @return PlainText
     */
    public function setRenderCallback(?string $renderCallback): PlainText
    {
        $this->renderCallback = $renderCallback;

        return $this;
    }

    /**
     * @return string|null The function name of a CSE callback to call when the newsletter is rendered
     */
    public function getRenderCallback(): ?string
    {
        return $this->renderCallback;
    }

    /**
     * @param string|null $content
     *
     * @return PlainText
     */
    public function setContent(?string $content): PlainText
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null The plain text to send
     */
    public function getContent(): ?string
    {
        return $this->content;
    }
}
