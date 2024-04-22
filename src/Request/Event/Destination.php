<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request\Event;

use MagicSunday\XmlSerializable;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview;

/**
 * The destination element encloses the description of the destinations to which the newsletter is to be sent,
 * i.e., the specification of the channels, virtual channels or a query. If a list of channels or virtual
 * channels and a query are specified as the target, then the newsletter will be sent to the recipients who
 * are included in one of the channels and for whom the query also applies.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Destination implements XmlSerializable
{
    /**
     * The channel element encloses a channel to which the newsletter should be sent. The internal name must be
     * specified as the name of the channel. To specify multiple channels, the channel element can be used
     * multiple times. It has no attributes.
     *
     * @var string[]
     */
    private array $channel = [];

    /**
     * The vchannel element encloses a virtual channel to which the newsletter should be sent. The internal
     * name must be specified as the name of the virtual channel. To specify multiple virtual channels, the
     * vchannel element can be used multiple times. It has no attributes.
     *
     * @var string[]
     */
    private array $vchannel = [];

    /**
     * The query element encloses a query that can be used to restrict or define the recipients of the newsletter.
     * The comparison operators < and > must be encoded as valid XML, so a > is written as &gt; and < as &lt; coded.
     * The query element has no attributes.
     *
     * @var string|null
     */
    private ?string $query = null;

    /**
     * Used for inbox preview with "Litmus".
     *
     * @var Preview|null
     */
    private ?Preview $preview = null;

    /**
     * @param string[] $channels
     *
     * @return Destination
     */
    public function setChannels(array $channels): Destination
    {
        $this->channel = $channels;

        return $this;
    }

    /**
     * @param string $channel
     *
     * @return Destination
     */
    public function addChannel(string $channel): Destination
    {
        $this->channel[] = $channel;

        return $this;
    }

    /**
     * @param string[] $virtualChannels
     *
     * @return Destination
     */
    public function setVChannels(array $virtualChannels): Destination
    {
        $this->vchannel = $virtualChannels;

        return $this;
    }

    /**
     * @param string $virtualChannel
     *
     * @return Destination
     */
    public function addVirtualChannel(string $virtualChannel): Destination
    {
        $this->vchannel[] = $virtualChannel;

        return $this;
    }

    /**
     * Sets the query to select the recipients to whom the newsletter should be addressed.
     *
     * @param string|null $query
     *
     * @return Destination
     */
    public function setQuery(?string $query): Destination
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @param Preview|null $preview
     *
     * @return Destination
     */
    public function setPreview(?Preview $preview): Destination
    {
        $this->preview = $preview;

        return $this;
    }
}
