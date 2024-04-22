<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Model;

/**
 * A newsletter channel record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class NewsletterChannel extends AbstractEntity
{
    /**
     * The unique ID of the newsletter channel.
     *
     * @var string
     */
    public string $id;

    /**
     * The title the newsletter channel.
     *
     * @var string
     */
    public string $title = '';

    /**
     * The description the newsletter channel.
     *
     * @var string
     */
    public string $description = '';

    /**
     * The public flag if this is a channel.
     *
     * @var bool
     */
    public bool $isPublic = false;

    /**
     * true = VChannel; false = Channel.
     *
     * @var bool
     */
    public bool $isVChannel = false;

    /**
     * OID.
     *
     * @var string
     */
    public string $oid = '';

    /**
     * The estimated number of entries in a channel or segment.
     *
     * @var int
     */
    public int $estimatedCount = 0;

    //    /**
    //     * TODO
    //     * Type unknown. API documentation incomplete.
    //     *
    //     * Custom attributes, never null.
    //     *
    //     * @var array
    //     */
    //    public array $customAttributes = [];
}
