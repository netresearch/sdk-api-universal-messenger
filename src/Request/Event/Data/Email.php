<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event\Data;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use MagicSunday\XmlSerializable;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\File;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\HtmlText;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\PlainText;

/**
 * The email element encloses the description of the email that is to be sent as a newsletter.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Email implements XmlSerializable
{
    /**
     * Optionally overwrites the sender ID preset in the configuration file
     * (make sure the email address format is correct: "John Doe <john.doe@example.org>").
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $sender = null;

    /**
     * Optionally overwrites the Reply-To address preset in the configuration file
     * (make sure the email address format is correct: "John Doe <john.doe@example.org>").
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $replyto = null;

    /**
     * Optionally overwrites the Envelope-From address preset in the configuration file
     * (make sure the email address format is correct: "John Doe <john.doe@example.org>").
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $envelopeFrom = null;

    /**
     * TRUE if the HTML email should only be sent to subscribers with the "html" attribute set.
     *
     * @var bool|null
     */
    #[XmlAttribute]
    private ?bool $obeyPreferHtml = null;

    /**
     * This flag is evaluated if an email newsletter contains a text email and also an HTML email.
     * If TRUE, the HTML email is sent as "multipart/alternative" and also contains the text part.
     * If FALSE, only the HTML email is sent.
     *
     * @var bool|null
     */
    #[XmlAttribute]
    private ?bool $sendBothParts = null;

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
     * Optionally overwrites the tracking preset in the configuration file.
     * Possible values: 'personal', 'anonymous', 'mixed', 'off'.
     * However, the "mixed" mode can only be selected here if the "mixed" mode is also set globally.
     *
     * @var string|null
     */
    #[XmlAttribute]
    private ?string $trackingMode = null;

    /**
     * Encloses the subject of the email.
     *
     * @var string|null
     */
    private ?string $subject = null;

    /**
     * HTML email details.
     *
     * @var HtmlText|null
     */
    private ?HtmlText $htmltext = null;

    /**
     * Text email details.
     *
     * @var PlainText|null
     */
    private ?PlainText $plaintext = null;

    /**
     * Information about the attachments.
     *
     * @var File[]
     */
    private array $file = [];

    /**
     * @param string|null $sender
     *
     * @return Email
     */
    public function setSender(?string $sender): Email
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return string|null The sender ID overwriting the configuration file preset
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @param string|null $replyto
     *
     * @return Email
     */
    public function setReplyto(?string $replyto): Email
    {
        $this->replyto = $replyto;

        return $this;
    }

    /**
     * @return string|null The Reply-To address overwriting the configuration file preset
     */
    public function getReplyto(): ?string
    {
        return $this->replyto;
    }

    /**
     * @param string|null $envelopeFrom
     *
     * @return Email
     */
    public function setEnvelopeFrom(?string $envelopeFrom): Email
    {
        $this->envelopeFrom = $envelopeFrom;

        return $this;
    }

    /**
     * @return string|null The Envelope-From address overwriting the configuration file preset
     */
    public function getEnvelopeFrom(): ?string
    {
        return $this->envelopeFrom;
    }

    /**
     * @param bool|null $obeyPreferHtml
     *
     * @return Email
     */
    public function setObeyPreferHtml(?bool $obeyPreferHtml): Email
    {
        $this->obeyPreferHtml = $obeyPreferHtml;

        return $this;
    }

    /**
     * @return bool|null TRUE if the HTML email should only be sent to subscribers with the "html" attribute set
     */
    public function getObeyPreferHtml(): ?bool
    {
        return $this->obeyPreferHtml;
    }

    /**
     * @param bool|null $sendBothParts
     *
     * @return Email
     */
    public function setSendBothParts(?bool $sendBothParts): Email
    {
        $this->sendBothParts = $sendBothParts;

        return $this;
    }

    /**
     * @return bool|null TRUE if the HTML email is sent as "multipart/alternative" and also contains the text part
     */
    public function getSendBothParts(): ?bool
    {
        return $this->sendBothParts;
    }

    /**
     * @param string|null $baseUrl
     *
     * @return Email
     */
    public function setBaseUrl(?string $baseUrl): Email
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
     * @return Email
     */
    public function setDownloadUrl(?string $downloadUrl): Email
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
     * @param string|null $trackingMode
     *
     * @return Email
     */
    public function setTrackingMode(?string $trackingMode): Email
    {
        $this->trackingMode = $trackingMode;

        return $this;
    }

    /**
     * @return string|null The tracking mode overwriting the configuration file preset
     */
    public function getTrackingMode(): ?string
    {
        return $this->trackingMode;
    }

    /**
     * @param string|null $subject
     *
     * @return Email
     */
    public function setSubject(?string $subject): Email
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string|null The subject of the email
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param HtmlText|null $htmltext
     *
     * @return Email
     */
    public function setHtmltext(?HtmlText $htmltext): Email
    {
        $this->htmltext = $htmltext;

        return $this;
    }

    /**
     * @return HtmlText|null The HTML email details
     */
    public function getHtmltext(): ?HtmlText
    {
        return $this->htmltext;
    }

    /**
     * @param PlainText|null $plaintext
     *
     * @return Email
     */
    public function setPlaintext(?PlainText $plaintext): Email
    {
        $this->plaintext = $plaintext;

        return $this;
    }

    /**
     * @return PlainText|null The text email details
     */
    public function getPlaintext(): ?PlainText
    {
        return $this->plaintext;
    }

    /**
     * @param File[] $files
     *
     * @return Email
     */
    public function setFiles(array $files): Email
    {
        $this->file = $files;

        return $this;
    }

    /**
     * @param File $file
     *
     * @return Email
     */
    public function addFile(File $file): Email
    {
        $this->file[] = $file;

        return $this;
    }

    /**
     * @return File[]
     */
    public function getFiles(): array
    {
        return $this->file;
    }
}
