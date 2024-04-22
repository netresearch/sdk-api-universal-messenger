<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\Serializer;

use MagicSunday\XmlEncoder;
use MagicSunday\XmlMapper\Converter\CamelCasePropertyNameConverter;
use Netresearch\Sdk\UniversalMessenger\Request\RequestInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Type;

use function is_bool;

/**
 * XmlSerializer.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class XmlSerializer
{
    /**
     * Maps the given request type instance to XML.
     *
     * @param RequestInterface $instance
     *
     * @return string|false
     */
    public function encode(RequestInterface $instance): string|false
    {
        $encoder = new XmlEncoder(
            new PropertyInfoExtractor(
                [
                    new ReflectionExtractor(
                        null,
                        null,
                        null,
                        true,
                        ReflectionExtractor::ALLOW_PRIVATE
                    ),
                ],
                [
                    new PhpDocExtractor(),
                ]
            ),
            new CamelCasePropertyNameConverter()
        );

        // Add handler for bool elements
        $encoder->addType(
            Type::BUILTIN_TYPE_BOOL,
            static function (string $propertyName, mixed $propertyValue): ?string {
                // Special treatment for "inline" attribute with "null" values
                if (
                    ($propertyName === 'inline')
                    && ($propertyValue === null)
                ) {
                    return 'none';
                }

                if (is_bool($propertyValue)) {
                    return match ($propertyValue) {
                        false => 'false',
                        true  => 'true',
                    };
                }

                return null;
            }
        );

        return $encoder->map($instance);
    }
}
