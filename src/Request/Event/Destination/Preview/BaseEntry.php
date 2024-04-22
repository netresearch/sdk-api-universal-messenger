<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use MagicSunday\XmlSerializable;

/**
 * In the email attribute, contains the email address with which an entry in Universal Messenger can be
 * uniquely identified to personalize the preview.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class BaseEntry implements XmlSerializable
{
    /**
     * The email address with which an entry in Universal Messenger can be
     * uniquely identified to personalize the preview.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $email = null;

    /**
     * @param string|null $email
     *
     * @return BaseEntry
     */
    public function setEmail(?string $email): BaseEntry
    {
        $this->email = $email;

        return $this;
    }
}
