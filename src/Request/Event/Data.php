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
use MagicSunday\XmlSerializable;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email;

/**
 * The data element encloses the entire area with the description of the content
 * that is to be sent in the newsletter.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Data implements XmlSerializable
{
    /**
     * Recipient email address with personalization variables, example: mailto="{otherEmailAttribute}".
     * This information is only necessary if the standard email address is to be changed.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $mailto = null;

    /**
     * Information about the email to be sent.
     *
     * @var Email|null
     */
    private ?Email $email = null;

    /**
     * Information about the internal message to be sent.
     *
     * @var string|null
     */
    private ?string $message = null;

    /**
     * @param string|null $mailto
     *
     * @return Data
     */
    public function setMailto(?string $mailto): Data
    {
        $this->mailto = $mailto;

        return $this;
    }

    /**
     * @param Email|null $email
     *
     * @return Data
     */
    public function setEmail(?Email $email): Data
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string|null $message
     *
     * @return Data
     */
    public function setMessage(?string $message): Data
    {
        $this->message = $message;

        return $this;
    }
}
