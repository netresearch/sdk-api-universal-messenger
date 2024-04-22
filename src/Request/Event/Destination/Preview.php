<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event\Destination;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use MagicSunday\XmlSerializable;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview\BaseEntry;

/**
 * The preview service.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Preview implements XmlSerializable
{
    /**
     * Specification of the preview service. Currently only "litmus" is possible as a value.
     *
     * @var string
     *
     * @XmlAttribute
     */
    private string $service = 'litmus';

    /**
     * In the email attribute, contains the email address with which an entry in Universal Messenger can be
     * uniquely identified to personalize the preview.
     *
     * @var BaseEntry|null
     */
    private ?BaseEntry $baseEntry = null;

    /**
     * @param string $service
     *
     * @return Preview
     */
    public function setService(string $service): Preview
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @param BaseEntry|null $baseEntry
     *
     * @return Preview
     */
    public function setBaseEntry(?BaseEntry $baseEntry): Preview
    {
        $this->baseEntry = $baseEntry;

        return $this;
    }
}
