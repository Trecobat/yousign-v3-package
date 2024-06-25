<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;
use Trecobat\YousignV3Package\Model\Signer;
use Trecobat\YousignV3Package\Model\Webhook;
use Trecobat\YousignV3Package\SignRequestYousign;

interface SignRequestYousignWebhookInterface
{
    /**
     * List Webhook subscriptions
     * List webhooks
     *
     * @return mixed
     */
    public function listWebkook();

    /**
     * Create a Webhook subscription
     * Configure a new webhook
     *
     * If you are testing the API, you only have access to the Sandbox environment.
     * You are limited in the webhooks creation: you can create Webhooks only from the application, and not from the API.
     *
     * @param Webhook $webhook
     * @return mixed
     */
    public function createWebhook( Webhook $webhook );

    /**
     * Delete a Webhook subscription
     * Unsubscribe a webhook
     *
     * @param string $webhookId
     * @return mixed
     */
    public function deleteWebhook(string $webhookId);

    /**
     * Get a Webhook subscription
     * Get a webhook
     *
     * @param string $webhookId
     * @return mixed
     */
    public function getWebhook(string $webhookId);

    /**
     * Update a Webhook subscription
     * Update a webhook
     *
     * @param string $webhookId
     * @param Webhook $webhook
     * @return mixed
     */
    public function updateWebhook(string $webhookId, Webhook $webhook);




}
