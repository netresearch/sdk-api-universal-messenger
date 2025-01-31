<?php

/**
 * This file is part of the package netresearch/sdk-api-universal-messenger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\UniversalMessenger\RequestBuilder\EventFile;

use Netresearch\Sdk\UniversalMessenger\Exception\RequestValidatorException;
use Netresearch\Sdk\UniversalMessenger\Request\Event;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\File;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\HtmlText;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Data\Email\PlainText;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Date;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview;
use Netresearch\Sdk\UniversalMessenger\Request\Event\Destination\Preview\BaseEntry;
use Netresearch\Sdk\UniversalMessenger\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\UniversalMessenger\Traits\EmailHtmlBodyTrait;
use Netresearch\Sdk\UniversalMessenger\Traits\EmailTextBodyTrait;

use function in_array;
use function is_array;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    use EmailHtmlBodyTrait;
    use EmailTextBodyTrait;

    /**
     * Sets the attachment's filename.
     *
     * @param string|null $id              Optional unique identifier (if no ID is specified, a random ID will be generated)
     * @param string|null $newsletterGroup
     * @param bool|null   $skipUsedIDs
     *
     * @return CreateRequestBuilder
     */
    public function setEventDetails(
        ?string $id = null,
        ?string $newsletterGroup = null,
        ?bool $skipUsedIDs = null,
    ): CreateRequestBuilder {
        $this->data['event']['id']              = $id;
        $this->data['event']['newsletterGroup'] = $newsletterGroup;
        $this->data['event']['skipUsedIDs']     = $skipUsedIDs;

        return $this;
    }

    /**
     * Sets the created by attribute.
     *
     * @param string|null $createdBy
     * @param string|null $createdByDisplayName
     *
     * @return CreateRequestBuilder
     */
    public function setEventCreatedBy(
        ?string $createdBy = null,
        ?string $createdByDisplayName = null,
    ): CreateRequestBuilder {
        $this->data['event']['createdBy']            = $createdBy;
        $this->data['event']['createdByDisplayName'] = $createdByDisplayName;

        return $this;
    }

    /**
     * Sets the created by display name attribute.
     *
     * @param bool $archive
     * @param bool $archiveSkipped
     *
     * @return CreateRequestBuilder
     */
    public function setEventArchiveSaving(
        bool $archive,
        bool $archiveSkipped,
    ): CreateRequestBuilder {
        $this->data['event']['archive']        = $archive;
        $this->data['event']['archiveSkipped'] = $archiveSkipped;

        return $this;
    }

    /**
     * Adds a tag.
     *
     * @param string $tag
     *
     * @return CreateRequestBuilder
     */
    public function addTag(string $tag): CreateRequestBuilder
    {
        if (!isset($this->data['event']['tag'])) {
            $this->data['event']['tag'] = [];
        }

        if (!in_array($tag, $this->data['event']['tag'], true)) {
            $this->data['event']['tag'][] = $tag;
        }

        return $this;
    }

    /**
     * Adds a channel.
     *
     * @param string $channel
     *
     * @return CreateRequestBuilder
     */
    public function addChannel(string $channel): CreateRequestBuilder
    {
        if (!isset($this->data['destination']['channel'])) {
            $this->data['destination']['channel'] = [];
        }

        if (!in_array($channel, $this->data['destination']['channel'], true)) {
            $this->data['destination']['channel'][] = $channel;
        }

        return $this;
    }

    /**
     * Adds a virtual channel.
     *
     * @param string $vchannel
     *
     * @return CreateRequestBuilder
     */
    public function addVirtualChannel(string $vchannel): CreateRequestBuilder
    {
        if (!isset($this->data['destination']['vchannel'])) {
            $this->data['destination']['vchannel'] = [];
        }

        if (!in_array($vchannel, $this->data['destination']['vchannel'], true)) {
            $this->data['destination']['vchannel'][] = $vchannel;
        }

        return $this;
    }

    /**
     * @param string|null $baseEntryEmail
     * @param string|null $service
     *
     * @return CreateRequestBuilder
     */
    public function setPreview(
        ?string $baseEntryEmail = null,
        ?string $service = null,
    ): CreateRequestBuilder {
        $this->data['destination']['preview']['baseEntryEmail'] = $baseEntryEmail;
        $this->data['destination']['preview']['service']        = $service;

        return $this;
    }

    /**
     * Sets the query to select the recipients to whom the newsletter should be addressed.
     *
     * @param string|null $query
     *
     * @return CreateRequestBuilder
     */
    public function setQuery(?string $query = null): CreateRequestBuilder
    {
        $this->data['destination']['query'] = $query;

        return $this;
    }

    /**
     * @param string      $date
     * @param string|null $format
     *
     * @return CreateRequestBuilder
     */
    public function setDate(string $date, ?string $format = null): CreateRequestBuilder
    {
        $this->data['date']['value']  = $date;
        $this->data['date']['format'] = $format;

        return $this;
    }

    /**
     * @param string|null $mailTo
     *
     * @return CreateRequestBuilder
     */
    public function setMailTo(
        ?string $mailTo,
    ): CreateRequestBuilder {
        $this->data['data']['mailTo'] = $mailTo;

        return $this;
    }

    /**
     * @param string|null $message
     *
     * @return CreateRequestBuilder
     */
    public function setMessage(
        ?string $message,
    ): CreateRequestBuilder {
        $this->data['data']['message'] = $message;

        return $this;
    }

    /**
     * @param string|null $baseUrl
     * @param string|null $downloadUrl
     *
     * @return CreateRequestBuilder
     */
    public function setEmailBaseAndDownloadUrl(
        ?string $baseUrl,
        ?string $downloadUrl = null,
    ): CreateRequestBuilder {
        $this->data['data']['email']['baseUrl']     = $baseUrl;
        $this->data['data']['email']['downloadUrl'] = $downloadUrl;

        return $this;
    }

    /**
     * @param string|null $sender
     * @param string|null $replyTo
     * @param string|null $envelopeFrom
     *
     * @return $this
     */
    public function setEmailAdresses(
        ?string $sender,
        ?string $replyTo = null,
        ?string $envelopeFrom = null,
    ): CreateRequestBuilder {
        $this->data['data']['email']['sender']       = $sender;
        $this->data['data']['email']['replyTo']      = $replyTo;
        $this->data['data']['email']['envelopeFrom'] = $envelopeFrom;

        return $this;
    }

    /**
     * @param string $subject
     *
     * @return CreateRequestBuilder
     */
    public function setEmailSubject(
        string $subject,
    ): CreateRequestBuilder {
        $this->data['data']['email']['subject'] = $subject;

        return $this;
    }

    public function setEmailTracking(
        string $trackingMode,
    ): CreateRequestBuilder {
        $this->data['data']['email']['trackingMode'] = $trackingMode;

        return $this;
    }

    /**
     * @param bool $obeyPreferHtml
     * @param bool $sendBothParts
     *
     * @return CreateRequestBuilder
     */
    public function setEmailBodyType(
        bool $obeyPreferHtml = false,
        bool $sendBothParts = false,
    ): CreateRequestBuilder {
        $this->data['data']['email']['obeyPreferHtml'] = $obeyPreferHtml;
        $this->data['data']['email']['sendBothParts']  = $sendBothParts;

        return $this;
    }

    /**
     * Adds a file.
     *
     * @param string|null $content
     * @param string|null $disposition
     * @param bool|null   $inline
     * @param string|null $name
     *
     * @return CreateRequestBuilder
     */
    public function addFile(
        ?string $content,
        ?string $disposition,
        ?bool $inline,
        ?string $name,
    ): CreateRequestBuilder {
        if (!isset($this->data['data']['email']['files'])) {
            $this->data['data']['email']['files'] = [];
        }

        $file = [
            'content'     => $content,
            'disposition' => $disposition,
            'inline'      => $inline,
            'name'        => $name,
        ];

        $fileHash = md5(serialize($file));

        if (!in_array($fileHash, $this->data['data']['email']['files'], true)) {
            $this->data['data']['email']['files'][$fileHash] = $file;
        }

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return Event
     *
     * @throws RequestValidatorException
     */
    public function create(): Event
    {
        // Validate the input
        //        CreateValidator::validate($this->data);

        // Event
        $event = new Event();
        $event->setId($this->data['event']['id'])
            ->setNewsletterGroup($this->data['event']['newsletterGroup'] ?? null)
            ->setCreatedBy($this->data['event']['createdBy'] ?? null)
            ->setCreatedByDisplayName($this->data['event']['createdByDisplayName'] ?? null)
            ->setArchive($this->data['event']['archive'] ?? null)
            ->setArchiveSkipped($this->data['event']['archiveSkipped'] ?? null)
            ->setSkipUsedIDs($this->data['event']['skipUsedIDs'] ?? null);

        if (
            isset($this->data['event']['tag'])
            && is_array($this->data['event']['tag'])
        ) {
            $event->setTags($this->data['event']['tag']);
        }

        // Destination
        if (isset($this->data['destination'])) {
            $destination = new Destination();
            $destination->setQuery($this->data['destination']['query'] ?? null);

            // Channels
            if (
                isset($this->data['destination']['channel'])
                && is_array($this->data['destination']['channel'])
            ) {
                $destination->setChannels($this->data['destination']['channel']);
            }

            // Virtual channels
            if (
                isset($this->data['destination']['vchannel'])
                && is_array($this->data['destination']['vchannel'])
            ) {
                $destination->setVChannels($this->data['destination']['vchannel']);
            }

            if (isset($this->data['destination']['preview'])) {
                $preview = new Preview();
                $preview
                    ->setBaseEntry(
                        (new BaseEntry())
                            ->setEmail($this->data['destination']['preview']['baseEntryEmail'] ?? null)
                    )
                    ->setService($this->data['destination']['preview']['service'] ?? null);

                $destination->setPreview($preview);
            }

            $event->setDestination($destination);
        }

        // Data
        if (isset($this->data['data'])) {
            $data = new Data();
            $data
                ->setMailto($this->data['data']['mailTo'] ?? null)
                ->setMessage($this->data['data']['message'] ?? null);

            // Email
            if (isset($this->data['data']['email'])) {
                $email = new Email();
                $email
                    ->setBaseUrl($this->data['data']['email']['baseUrl'] ?? null)
                    ->setDownloadUrl($this->data['data']['email']['downloadUrl'] ?? null)
                    ->setEnvelopeFrom($this->data['data']['email']['envelopeFrom'] ?? null)
                    ->setObeyPreferHtml($this->data['data']['email']['obeyPreferHtml'] ?? null)
                    ->setReplyto($this->data['data']['email']['replyTo'] ?? null)
                    ->setSendBothParts($this->data['data']['email']['sendBothParts'] ?? null)
                    ->setSender($this->data['data']['email']['sender'] ?? null)
                    ->setSubject($this->data['data']['email']['subject'] ?? null)
                    ->setTrackingMode($this->data['data']['email']['trackingMode'] ?? null)
                    ->setHtmltext(
                        (new HtmlText())
                            ->setBaseUrl($this->data['data']['html']['baseUrl'] ?? null)
                            ->setCharset($this->data['data']['html']['charset'] ?? null)
                            ->setContent($this->data['data']['html']['content'] ?? null)
                            ->setDownloadUrl($this->data['data']['html']['downloadUrl'] ?? null)
                            ->setEmbedImages($this->data['data']['html']['embedImages'] ?? 'byPath')
                            ->setInline($this->data['data']['html']['inline'] ?? null)
                            ->setLinkTracking($this->data['data']['html']['linkTracking'] ?? null)
                            ->setRenderCallback($this->data['data']['html']['renderCallback'] ?? null)
                            ->setRestProxyUrl($this->data['data']['html']['restProxyUrl'] ?? null)
                            ->setViewTracking($this->data['data']['html']['viewTracking'] ?? null)
                    )
                    ->setPlaintext(
                        (new PlainText())
                            ->setBaseUrl($this->data['data']['text']['baseUrl'] ?? null)
                            ->setCharset($this->data['data']['text']['charset'] ?? null)
                            ->setContent($this->data['data']['text']['content'] ?? null)
                            ->setDownloadUrl($this->data['data']['text']['downloadUrl'] ?? null)
                            ->setInline($this->data['data']['text']['inline'] ?? null)
                            ->setLinkTracking($this->data['data']['text']['linkTracking'] ?? null)
                            ->setRenderCallback($this->data['data']['text']['renderCallback'] ?? null)
                    );

                if (isset($this->data['data']['email']['files'])) {
                    foreach ($this->data['data']['email']['files'] as $file) {
                        $email->addFile(
                            (new File())
                                ->setContent($file['content'] ?? null)
                                ->setDisposition($file['disposition'] ?? null)
                                ->setInline($file['inline'] ?? null)
                                ->setName($file['name'] ?? null)
                        );
                    }
                }

                $data->setEmail($email);
            }

            $event->setData($data);
        }

        // Date
        if (isset($this->data['date'])) {
            $date = new Date($this->data['date']['value']);
            $date->setFormat($this->data['date']['format']);

            $event->setDate($date);
        }

        $this->data = [];

        return $event;
    }
}
