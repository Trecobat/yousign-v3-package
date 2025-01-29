<?php

namespace Trecobat\YousignV3Package;

use GuzzleHttp\Client;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignWebhookInterface;
use Trecobat\YousignV3Package\Model\SignatureRequest;
use Trecobat\YousignV3Package\Model\Webhook;


class YousignSrApiClient implements SignRequestYousignWebhookInterface
{
    //private string $apiBaseUrl;
    private $apiBaseUrl;
    //private string $apiVerion = "v3";
    private $apiVerion = "v3";
    //private string $apiKey ;
    private $apiKey ;
    //private Client $client;
    private $client;
    //private array $headers;
    private $headers;

    /**
     * Construction du client YOUSIGN
     * @param string $apiKey
     * @param string $apiUrl
     */
    public function __construct(string $apiKey,string $apiUrl)
    {

        $this->apiBaseUrl = $apiUrl;
        $this->apiKey = $apiKey;

        $this->client = new Client(
            ['base_uri' => $this->apiBaseUrl]);

        $this->headers = [
            "accept" => "application/json",
            "content-type" => "application/json",
            "Authorization" => "Bearer " . $this->apiKey
        ];

    }

    /**
     * Ajout d'une signature request chez YouSign
     * @param SignatureRequest $signatureRequest
     * @return
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createSignatureRequest(SignatureRequest $signatureRequest){

        /*echo("\r\nBODY : " );
        var_dump("\r\n".$signatureRequest->toJson());*/

        $response = $this->client->request('POST', "signature_requests", [
            "headers" => $this->headers,
            'body' => $signatureRequest->toJson(),
        ]);

        $objRetourApi = json_decode($response->getBody());
        $resp = new SignRequestYousign($objRetourApi->id,$objRetourApi->name, $this->apiBaseUrl,$this->apiKey);

        return $resp;
    }

    /**
     * Permet de lister les demandes de signatures
     * @param $tabQueryParams
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listSignatureRequest($tabQueryParams = false){
        $queryParams = "";
        if( $tabQueryParams ){
            $queryParams = "?".http_build_query($tabQueryParams);
        }
        $response = $this->client->request('GET', 'signature_requests' . $queryParams, [
            'headers' => $this->headers
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Récupération d'une demande de signature à partir de son ID
     *
     * @param String $signatureRequestId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSignatureRequest(String $signatureRequestId ){

        $response = $this->client->request("GET", "signature_requests/$signatureRequestId", [
            'headers' => $this->headers
        ]);

        return json_decode( $response->getBody() );
    }



    /**
     * List Webhook subscriptions
     * List webhooks
     *
     * @return mixed
     */
    public function listWebkook()
    {
        $response = $this->client->request('GET', 'webhooks', [
            'headers' => $this->headers
        ]);

        return json_decode( $response->getBody() );
    }

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
    public function createWebhook(Webhook $webhook)
    {
        $response = $this->client->request('POST', 'webhooks', [
            'headers' => $this->headers,
            'json' => $webhook
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Delete a Webhook subscription
     * Unsubscribe a webhook
     *
     * Only in production environment
     *
     * @param string $webhookId
     * @return mixed
     */
    public function deleteWebhook(string $webhookId)
    {
        $response = $this->client->request("DELETE", "webhooks/$webhookId", [
            'headers' => $this->headers
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Get a Webhook subscription
     * Get a webhook
     *
     * @param string $webhookId
     * @return mixed
     */
    public function getWebhook(string $webhookId)
    {
        $response = $this->client->request("GET", "webhooks/$webhookId", [
            'headers' => $this->headers
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Update a Webhook subscription
     * Update a webhook
     *
     * @param string $webhookId
     * @param Webhook $webhook
     * @return mixed
     */
    public function updateWebhook(string $webhookId, Webhook $webhook)
    {
        $response = $this->client->request("PATCH", "webhooks/$webhookId", [
            'headers' => $this->headers,
            'json' => $webhook
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }


}
