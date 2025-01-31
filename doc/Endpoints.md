# Endpoints
The SDK currently implements the following API endpoints:

* [EventFile](#eventfile)
* [Channels](#channels)
* [Newsletter Status](#newsletter-status)


## EventFile
The Universal Messenger can be connected to an existing content management system (CMS) for maintaining the website
via an XML-based interface, so that the newsletter can be created in the familiar environment of the content
management system and with the existing workflows. The newsletters created by the content management system are
transferred to the Universal Messenger with additional shipping information via an XML event file.

### Endpoint URL
```
https://<BASE-URL>/de.pinuts.cmsbs.restsend.EventFile/?open=
```

### HTTP method
```
POST
```

### Requirements
- The `Content-Type` must be `text/xml`.
- The `charset` must be specified correctly.
- For `api-key` or `secret-key`, an API key pair with the authorization `de.pinuts.cmsbs.restapi:SendNewsletter` must be specified.


## Channels
Returns a list of Channels (aka Lists) and VChannels (aka Segments).

### Endpoint URL
```
https://<BASE-URL>/de.pinuts.cmsbs.restapi.Channels/index?umopen=
```

### HTTP method
```
GET
```

### Requirements
- For `api-key` or `secret-key`, an API key pair with the authorization `de.pinuts.cmsbs.restapi:ListChannels` must be specified.


## Newsletter Status
Returns a status report for a Newsletter by its event identifier.

### Endpoint URL
```
https://<BASE-URL>/de.pinuts.cmsbs.restapi.NewsletterQueue/status/<eventId>?umopen=
```

### HTTP method
```
GET
```

### Requirements
- For `api-key` or `secret-key`, an API key pair with the authorization `de.pinuts.cmsbs.restapi:GetNewsletterQueueStatus` must be specified.
