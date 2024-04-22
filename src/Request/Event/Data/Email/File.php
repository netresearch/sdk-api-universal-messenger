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
 * Information about an attachment.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class File implements XmlSerializable
{
    /**
     * Optionally defines a "content-name" for the attachment (in the default case the file name),
     * which can be referenced in the email using "cid:content-name".
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $name = null;

    /**
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $disposition = null;

    /**
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $inline = null;

    /**
     * The base64 encoded file content.
     *
     * @var string|null
     *
     * @XmlNodeValue
     */
    private ?string $content = null;

    /**
     * @param string|null $name
     *
     * @return File
     */
    public function setName(?string $name): File
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $disposition
     *
     * @return File
     */
    public function setDisposition(?string $disposition): File
    {
        $this->disposition = $disposition;

        return $this;
    }

    /**
     * @param bool|null $inline
     *
     * @return File
     */
    public function setInline(?bool $inline): File
    {
        $this->inline = $inline;

        return $this;
    }

    /**
     * @param string|null $content
     *
     * @return File
     */
    public function setContent(?string $content): File
    {
        $this->content = $content;

        return $this;
    }
}
