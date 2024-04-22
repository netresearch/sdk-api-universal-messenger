<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Model;

use DateTime;

/**
 * A newsletter status record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class NewsletterStatus extends AbstractEntity
{
    /**
     * The event ID of the newsletter.
     *
     * @var string
     */
    public string $eventId;

    /**
     * OID.
     *
     * @var string
     */
    public string $oid = '';

    /**
     * Send state.
     *
     * @var int
     */
    public int $sendState = 0;

    /**
     * Send date.
     *
     * @var DateTime|null
     */
    public ?DateTime $sendDate = null;

    /**
     * Contacted.
     *
     * @var int
     */
    public int $contacted = 0;

    /**
     * Counted.
     *
     * @var int
     */
    public int $counted = 0;

    /**
     * Not counted.
     *
     * @var int
     */
    public int $notContacted = 0;

    /**
     * In queue?
     *
     * @var bool
     */
    public bool $inQueue = false;

    /**
     * Is failed?
     *
     * @var bool
     */
    public bool $isFailed = false;

    /**
     * Is finished?
     *
     * @var bool
     */
    public bool $isFinished = false;

    /**
     * Is stopped?
     *
     * @var bool
     */
    public bool $isStopped = false;
}
