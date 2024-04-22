<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use MagicSunday\XmlMapper\Annotation\XmlNodeValue;
use MagicSunday\XmlSerializable;

/**
 * The date element allows you to specify a sending time for the newsletter and is optional.
 * If this element is not specified, the newsletter will be sent immediately.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Date implements XmlSerializable
{
    /**
     * The date/time value.
     *
     * @var string
     *
     * @XmlNodeValue
     */
    private readonly string $value;

    /**
     * Defines the date/time format between tags (see Date and Time Formatting Characters).
     * The default format is "dd.MM.yyyy HH:mm:ss".
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $format = null;

    /**
     * Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string|null $format
     *
     * @return Date
     */
    public function setFormat(?string $format): Date
    {
        $this->format = $format;

        return $this;
    }
}
