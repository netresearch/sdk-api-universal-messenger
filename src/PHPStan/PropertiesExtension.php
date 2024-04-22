<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\PHPStan;

use PHPStan\Reflection\PropertyReflection;
use PHPStan\Rules\Properties\ReadWritePropertiesExtension;

/**
 * This PHPStan extension class is used to prevent PHPStan from reporting false positives 'Property
 * XYZ is never read, only written' errors.
 *
 * See https://phpstan.org/developing-extensions/always-read-written-properties
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class PropertiesExtension implements ReadWritePropertiesExtension
{
    /**
     * @param PropertyReflection $property
     * @param string             $propertyName
     *
     * @return bool
     */
    public function isAlwaysRead(PropertyReflection $property, string $propertyName): bool
    {
        return $this->isBelongsToRequestClass($property);
    }

    /**
     * @param PropertyReflection $property
     * @param string             $propertyName
     *
     * @return bool
     */
    public function isAlwaysWritten(PropertyReflection $property, string $propertyName): bool
    {
        return $this->isBelongsToRequestClass($property);
    }

    /**
     * @param PropertyReflection $property
     * @param string             $propertyName
     *
     * @return bool
     */
    public function isInitialized(PropertyReflection $property, string $propertyName): bool
    {
        return $this->isBelongsToRequestClass($property);
    }

    /**
     * @param PropertyReflection $property
     *
     * @return bool
     */
    private function isBelongsToRequestClass(PropertyReflection $property): bool
    {
        // If the class belongs to the request part of the SDK always return TRUE
        return str_contains($property->getDeclaringClass()->getName(), 'Netresearch\Sdk\UniversalMessenger\Request');
    }
}
