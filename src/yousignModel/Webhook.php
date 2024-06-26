<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Webhook
 */
class Webhook extends YousignModelApi
{
    /**
     * Https target URL of the webhook
     *
     * @var string
     */
    public string $endpoint;

    /**
     * Short description of the webhook.
     * This property cannot start or end with whitespace, does not allow HTML tags, URL or email.
     *
     * @var string
     */
    public string $description;

    /**
     * @var bool
     */
    public bool $sandbox;

    /**
     * List of specific webhook events to subscribe to.
     *
     * @var array
     */
    public array $subscribed_events;

    /**
     * Autogenerated 32 bytes key
     *
     * @var string
     */
    public string $secret_key;

    /**
     * One or multiple specific scopes to subscribe.
     *
     * @var array
     */
    public array $scopes;

    /**
     * If a Webhook request fails for any reason,
     * Yousign will retry the request 8 times using a back-off mechanism
     * after: 2, 6, 30, 60, 300, 1080, 1440, 2880 min
     *
     * @var bool
     */
    public bool $auto_retry;

    /**
     * Choose whether the webhook is enabled or not.
     * @var bool
     */
    public bool $enabled;

    /**
     * @param string $endpoint
     * @param string $description
     * @param bool $sandbox
     * @param array $subscribed_events
     * @param string $secret_key
     * @param array $scopes
     */
    public function __construct(string $endpoint, string $description, bool $sandbox, array $subscribed_events = null, string $secret_key = null, array $scopes = null)
    {
        $this->endpoint = $endpoint;
        $this->description = $description;
        $this->sandbox = $sandbox;
        $this->subscribed_events = $subscribed_events;
        $this->secret_key = $secret_key;
        $this->scopes = $scopes;
    }

    public function addSubscridedEvent(String $event){
        $this->subscribed_events[] = $event;
    }

    public function addScope(String $scope){
        $this->scopes[] = $scope;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param bool $sandbox
     */
    public function setSandbox(bool $sandbox): void
    {
        $this->sandbox = $sandbox;
    }

    /**
     * @param array $subscribed_events
     */
    public function setSubscribedEvents(?array $subscribed_events): void
    {
        $this->subscribed_events = $subscribed_events;
    }

    /**
     * @param string $secret_key
     */
    public function setSecretKey(?string $secret_key): void
    {
        $this->secret_key = $secret_key;
    }

    /**
     * @param array $scopes
     */
    public function setScopes(?array $scopes): void
    {
        $this->scopes = $scopes;
    }

    /**
     * @param bool $auto_retry
     */
    public function setAutoRetry(bool $auto_retry): void
    {
        $this->auto_retry = $auto_retry;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }




}
