<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Request;

use MagicSunday\XmlMapper\Annotation\XmlAttribute;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Date;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination;

/**
 * The event request object.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Event implements RequestInterface
{
    /**
     * Optional unique identifier (if no ID is specified, a random ID will be generated).
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $id = null;

    /**
     * Optional specification of a newsletter series to which the newsletter should be assigned.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $newsletterGroup = null;

    /**
     * TRUE (default) if the sending should be canceled if there is already a newsletter
     * with the same event ID in the archive.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $skipUsedIDs = null;

    /**
     * If set to TRUE (default), skipped newsletters are saved in the archive with the status “Cancelled”
     * and can still be sent there if necessary.
     *
     * Set to FALSE if skipped newsletters (skipedUsedIDs = "true") should not be saved in the newsletter archive.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $archiveSkipped = null;

    /**
     * FALSE if the newsletter should not be saved in the archive.
     *
     * @var bool|null
     *
     * @XmlAttribute
     */
    private ?bool $archive = null;

    /**
     * Optional indication of the username of the user who triggered the newsletter dispatch.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $createdBy = null;

    /**
     * Optional indication of the display username, the user who triggered the newsletter dispatch.
     *
     * @var string|null
     *
     * @XmlAttribute
     */
    private ?string $createdByDisplayName = null;

    /**
     * @var Destination|null
     */
    private ?Destination $destination = null;

    /**
     * @var Data|null
     */
    private ?Data $data = null;

    /**
     * The date element allows you to specify a sending time for the newsletter and is optional.
     * If this element is not specified, the newsletter will be sent immediately.
     *
     * @var Date|null
     */
    private ?Date $date = null;

    //    /**
    //     * @var null|ExportArchive
    //     */
    //    private ?ExportArchive $exportArchive = null;

    /**
     * @var string[]
     */
    private array $tag = [];

    //    /**
    //     * @var null|PreExec
    //     */
    //    private ?PreExec $preExec = null;

    /**
     * @param string|null $id
     *
     * @return Event
     */
    public function setId(?string $id): Event
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string|null $newsletterGroup
     *
     * @return Event
     */
    public function setNewsletterGroup(?string $newsletterGroup): Event
    {
        $this->newsletterGroup = $newsletterGroup;

        return $this;
    }

    /**
     * @param bool|null $skipUsedIDs
     *
     * @return Event
     */
    public function setSkipUsedIDs(?bool $skipUsedIDs): Event
    {
        $this->skipUsedIDs = $skipUsedIDs;

        return $this;
    }

    /**
     * @param bool|null $archiveSkipped
     *
     * @return Event
     */
    public function setArchiveSkipped(?bool $archiveSkipped): Event
    {
        $this->archiveSkipped = $archiveSkipped;

        return $this;
    }

    /**
     * @param bool|null $archive
     *
     * @return Event
     */
    public function setArchive(?bool $archive): Event
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * @param string|null $createdBy
     *
     * @return Event
     */
    public function setCreatedBy(?string $createdBy): Event
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @param string|null $createdByDisplayName
     *
     * @return Event
     */
    public function setCreatedByDisplayName(?string $createdByDisplayName): Event
    {
        $this->createdByDisplayName = $createdByDisplayName;

        return $this;
    }

    /**
     * @param Destination|null $destination
     *
     * @return Event
     */
    public function setDestination(?Destination $destination): Event
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @param Data|null $data
     *
     * @return Event
     */
    public function setData(?Data $data): Event
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param Date|null $date
     *
     * @return Event
     */
    public function setDate(?Date $date): Event
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param string[] $tags
     *
     * @return Event
     */
    public function setTags(array $tags): Event
    {
        $this->tag = $tags;

        return $this;
    }

    /**
     * @param string $tag
     *
     * @return Event
     */
    public function addTag(string $tag): Event
    {
        $this->tag[] = $tag;

        return $this;
    }
}
