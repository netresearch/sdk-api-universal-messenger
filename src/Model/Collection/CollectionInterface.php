<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Model\Collection;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * CollectionInterface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @template TKey
 * @template TValue
 *
 * @extends ArrayAccess<TKey, TValue>
 * @extends Iterator<TKey, TValue>
 */
interface CollectionInterface extends ArrayAccess, Countable, Iterator
{
}
