<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Serializer;

use Closure;
use DateTime;
use InvalidArgumentException;
use JsonException;
use MagicSunday\JsonMapper;
use MagicSunday\JsonMapper\Converter\CamelCasePropertyNameConverter;
use Netresearch\Sdk\UniversalMessenger\Request\RequestInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;

use function is_array;
use function json_decode;
use function json_encode;

/**
 * Serializer for outgoing request types and incoming responses.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @template TEntity
 * @template TEntityCollection
 */
class JsonSerializer
{
    /**
     * @var string[]|Closure[]
     */
    private readonly array $classMap;

    /**
     * JsonSerializer constructor.
     *
     * @param string[]|Closure[] $classMap A class map to override the default class names (source => target)
     */
    public function __construct(array $classMap = [])
    {
        $this->classMap = $classMap;
    }

    /**
     * Maps the given request type instance to JSON.
     *
     * @param RequestInterface $object
     *
     * @return string
     *
     * @throws JsonException
     */
    public function encode(RequestInterface $object): string
    {
        // Remove empty entries from serialized data (after all objects were converted to array)
        $payload = json_encode($object, JSON_THROW_ON_ERROR);
        $payload = (array) json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        $payload = $this->removeNullValuesRecursive($payload);

        return json_encode($payload, JSON_THROW_ON_ERROR);
    }

    /**
     * Recursively filters an array, removing all entries evaluating to FALSE.
     *
     * @param mixed[] $data Input array to filter
     *
     * @return mixed[] Filtered array
     */
    private function removeNullValuesRecursive(array $data): array
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $value = $this->removeNullValuesRecursive($value);
            }
        }

        // Remove all NULL values
        return array_filter(
            $data,
            static fn ($value): bool => $value !== null
        );
    }

    /**
     * Decodes the JSON string into PHP objects.
     *
     * @param string                               $jsonResponse
     * @param class-string<TEntity>|null           $className
     * @param class-string<TEntityCollection>|null $collectionClassName
     *
     * @return ($collectionClassName is class-string<TEntityCollection>
     *              ? TEntityCollection
     *              : ($className is class-string<TEntity> ? TEntity : null|mixed))
     *
     * @throws InvalidArgumentException
     * @throws JsonException
     */
    public function decode(
        string $jsonResponse,
        ?string $className = null,
        ?string $collectionClassName = null
    ) {
        $extractor = new PropertyInfoExtractor(
            [
                new ReflectionExtractor(),
            ],
            [
                new PhpDocExtractor(),
            ]
        );

        $decoder = new JsonMapper(
            $extractor,
            PropertyAccess::createPropertyAccessor(),
            new CamelCasePropertyNameConverter(),
            $this->classMap
        );

        // Add handler for DateTime elements
        $decoder->addType(
            DateTime::class,
            static function ($value): ?DateTime {
                if ($value) {
                    // Converts dates like "2018-11-12|13:45:24" to a valid DateTime
                    $convertedDate = DateTime::createFromFormat('Y-m-d?H:i:s', $value);

                    return $convertedDate !== false ? $convertedDate : null;
                }

                return null;
            }
        );

        $json = json_decode($jsonResponse, true, 512, JSON_THROW_ON_ERROR);

        return $decoder->map($json, $className, $collectionClassName);
    }
}
