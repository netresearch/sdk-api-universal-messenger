<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Model\Collection;

use JsonSerializable;

use function array_key_exists;
use function array_slice;
use function count;

/**
 * An abstract collection of values.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @template TKey
 * @template TValue
 *
 * @implements CollectionInterface<TKey, TValue>
 */
abstract class AbstractCollection implements CollectionInterface, JsonSerializable
{
    /**
     * An array containing the elements of this collection.
     *
     * @var TValue[]
     */
    protected array $elements = [];

    /**
     * Constructs a list of values.
     *
     * @param TValue[] $array Array of values
     */
    public function __construct(array $array = [])
    {
        $this->elements = $array;
    }

    /**
     * Offset to retrieve.
     *
     * @param TKey $offset The offset to retrieve
     *
     * @return TValue|null
     */
    public function offsetGet($offset): mixed
    {
        return $this->elements[$offset] ?? null;
    }

    /**
     * Offset to set.
     *
     * @param TKey   $offset The offset to assign the value to
     * @param TValue $value  The value to set
     */
    public function offsetSet($offset, $value): void
    {
        $this->elements[$offset] = $value;
    }

    /**
     * Offset to unset.
     *
     * @param TKey $offset The offset to unset
     */
    public function offsetUnset($offset): void
    {
        unset($this->elements[$offset]);
    }

    /**
     * Whether an offset exists.
     *
     * @param TKey $offset An offset to check for
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->elements);
    }

    /**
     * Count elements of an object.
     *
     * @return int<0, max>
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * Appends a value to the collection.
     *
     * @param TValue $value The value to append
     */
    public function append($value): void
    {
        $this->elements[] = $value;
    }

    /**
     * Rewind to the first element.
     *
     * @return void
     */
    public function rewind(): void
    {
        reset($this->elements);
    }

    /**
     * Return the current element.
     *
     * @return false|TValue
     */
    public function current(): mixed
    {
        return current($this->elements);
    }

    /**
     * Return the key of the current element.
     *
     * @return int|string|null
     */
    public function key(): int|string|null
    {
        return key($this->elements);
    }

    /**
     * Move forward to the next element.
     */
    public function next(): void
    {
        next($this->elements);
    }

    /**
     * Checks if current position is valid.
     *
     * @return bool
     */
    public function valid(): bool
    {
        $key = $this->key();

        if ($key !== null) {
            return array_key_exists($key, $this->elements);
        }

        return false;
    }

    /**
     * Returns the collection as a plain array.
     *
     * @return TValue[]
     */
    public function asArray(): array
    {
        return $this->elements;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return TValue[]
     */
    public function jsonSerialize(): array
    {
        return $this->elements;
    }

    /**
     * Sort the elements using a callback function.
     *
     * @param callable $callback The callback function to use
     *
     * @return self<TKey, TValue>
     */
    public function sort(callable $callback): self
    {
        uasort($this->elements, $callback);

        return $this;
    }

    /**
     * Filters the elements using a callback function.
     *
     * @param callable $callback The callback function to use
     *
     * @return self<TKey, TValue>
     */
    public function filter(callable $callback): self
    {
        $this->elements = array_filter($this->elements, $callback);

        return $this;
    }

    /**
     * Extract a slice of the array.
     *
     * @param int      $offset If the offset is non-negative, the sequence will start at that offset in the array. If
     *                         offset is negative, the sequence will start that far from the end of the array.
     * @param int|null $length If length is given and is positive, then the sequence will have that many elements
     *                         in it. If length is given and is negative, then the sequence will stop that many
     *                         elements from the end of the array. If it is omitted, then the sequence will have
     *                         everything from offset up until the end of the array.
     *
     * @return self<TKey, TValue>
     */
    public function slice(int $offset, ?int $length = null): self
    {
        $this->elements = array_slice($this->elements, $offset, $length);

        return $this;
    }
}
