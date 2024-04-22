<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\RequestBuilder;

use Netresearch\Sdk\UniversalMessenger\Exception\RequestValidatorException;
use Netresearch\Sdk\UniversalMessenger\Request\RequestInterface;

/**
 * The request builder interface specifies methods for creating the different parts of the request
 * builder objects. Each request builder must provide methods to quickly and easily set the data
 * required for the respective request without having to know the underlying API structure.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
interface RequestBuilderInterface
{
    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface;
}
