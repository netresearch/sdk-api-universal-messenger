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
use MagicSunday\XmlMapper\Annotation\XmlCDataSection;
use MagicSunday\XmlSerializable;

/**
 * The htmltext element encloses the area describing the HTML email. If the HTML source code contains
 * a link to an external style sheet file, this style sheet will be inserted directly into the HTML
 * source code by Universal Messenger, as external style sheets are not interpreted correctly by many
 * mail programs. The stylesheet file is downloaded from the address specified by the downloadUrl attribute.
 * If this attribute is not specified, the stylesheet file is downloaded from the address specified by
 * the baseUrl attribute of the email element.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class HtmlText implements XmlSerializable
{
    /**
     * TRUE if the HTML text to be sent is specified directly as the content of the htmltext element.
     * FALSE if the HTML text to be sent is to be read from the file or the URL specified with an
     * absolute path "none" if there is no HTML e-mail Email should be sent.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $inline = null;

    /**
     * Specification of the encoding.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $charset = null;

    /**
     * Behavior for embedding images.
     *
     * all    - if all images should be embedded in the email.
     * byPath - if all images should be embedded with a relative link (default setting).
     * none   - if no images are to be embedded.
     *
     * @var string
     *
     * @XmlAttribute
     */
    private string $embedImages = 'byPath';

    /**
     * URL that precedes the relative links.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $baseUrl = null;

    /**
     * URL from which referenced files are downloaded. If this attribute is not specified,
     * then the baseUrl attribute from the email element is used instead.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $downloadUrl = null;

    /**
     * FALSE if click tracking should be deactivated for this newsletter.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $linkTracking = null;

    /**
     * FALSE if tracking of opens for this newsletter should be deactivated.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $viewTracking = null;

    /**
     * Function name of a CSE callback to be called when the newsletter is rendered.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $renderCallback = null;

    /**
     * Url of the publicly accessible REST proxy.
     *
     * If this attribute is set, the referenced files are saved in the Universal Messenger in their current
     * state, and the URLs in the email are automatically rewritten so that the files are delivered via the
     * REST proxy. This means that they can be on a system that does not have to be directly accessible via
     * the Internet. They can also be accessed at any time in the newsletter archive, and recipients of
     * newsletters can open older newsletters without the referenced files no longer being available.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $restProxyUrl = null;

    /**
     * The HTML text to send.
     *
     * @var string|null
     *
     * @XmlCDataSection
     */
    private ?string $content = null;

    /**
     * @param bool|null $inline
     *
     * @return HtmlText
     */
    public function setInline(?bool $inline): HtmlText
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * @param string|null $charset
     *
     * @return HtmlText
     */
    public function setCharset(?string $charset): HtmlText
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * @param string $embedImages
     *
     * @return HtmlText
     */
    public function setEmbedImages(string $embedImages): HtmlText
    {
        $this->embedImages = $embedImages;

        return $this;
    }

    /**
     * @param string|null $baseUrl
     *
     * @return HtmlText
     */
    public function setBaseUrl(?string $baseUrl): HtmlText
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @param string|null $downloadUrl
     *
     * @return HtmlText
     */
    public function setDownloadUrl(?string $downloadUrl): HtmlText
    {
        $this->downloadUrl = $downloadUrl;

        return $this;
    }

    /**
     * @param bool|null $linkTracking
     *
     * @return HtmlText
     */
    public function setLinkTracking(?bool $linkTracking): HtmlText
    {
        $this->linkTracking = $linkTracking;

        return $this;
    }

    /**
     * @param bool|null $viewTracking
     *
     * @return HtmlText
     */
    public function setViewTracking(?bool $viewTracking): HtmlText
    {
        $this->viewTracking = $viewTracking;

        return $this;
    }

    /**
     * @param string|null $renderCallback
     *
     * @return HtmlText
     */
    public function setRenderCallback(?string $renderCallback): HtmlText
    {
        $this->renderCallback = $renderCallback;

        return $this;
    }

    /**
     * @param string|null $restProxyUrl
     *
     * @return HtmlText
     */
    public function setRestProxyUrl(?string $restProxyUrl): HtmlText
    {
        $this->restProxyUrl = $restProxyUrl;

        return $this;
    }

    /**
     * @param string|null $content
     *
     * @return HtmlText
     */
    public function setContent(?string $content): HtmlText
    {
        $this->content = $content;

        return $this;
    }
}
