<?php

namespace Trecobat\YousignV3Package;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignApproverInterface;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignAuditTrailInterface;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignDocumentInterface;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignFollowerInterface;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignMetadataInterface;
use Trecobat\YousignV3Package\Interfaces\SignRequestYousignSignersInterface;
use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;
use Trecobat\YousignV3Package\Model\Signer;

class SignRequestYousign implements SignRequestYousignApproverInterface, SignRequestYousignAuditTrailInterface,
    SignRequestYousignDocumentInterface, SignRequestYousignFollowerInterface, SignRequestYousignMetadataInterface,
    SignRequestYousignSignersInterface
{
    private string $apiBaseUrl;
    private string $apiKey;
    private array $headers;
    private Client $clientApi;
    private string $signatureRequestId;
    private string $signatureRequestName;
    private array $approverIds;
    private array $documentIds;
    private array $signerIds;

    /**
     * Contructeur de l'objet SIgnRequest Yousign
     *
     * @param $srId
     * @param $srName
     * @param $clientAPi
     */
    public function __construct($srId,$srName, string $apiBaseUrl,$apiKey)
    {
        $this->signatureRequestId = $srId;
        $this->signatureRequestName = $srName;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->apiKey = $apiKey;
        $this->clientApi = new Client(
            ['base_uri' => $this->apiBaseUrl]);
        $this->headers = [
            "accept" => "application/json",
            "content-type" => "application/json",
            "Authorization" => "Bearer " . $this->apiKey
        ];
    }

    /***************************************/
    /** SIGNATURE REQUESTS */
    /***************************************/

    /**
     * TODO : a tester
     * Activate a signature request
     * @return mixed
     */
    public function activate(){
        $request = new Request('POST',"signature_requests/".$this->signatureRequestId."/activate", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        return json_decode($res->getBody()) ;
    }

    /**
     * TODO : a tester
     * Cancel a signature request (in Approval or Ongoing status)
     * @return mixed
     */
    public function cancel($reason,$custom_note){
        $request = new Request('POST',"signature_requests/".$this->signatureRequestId."/cancel", $this->headers, json_encode([$reason,$custom_note]));
        $res = $this->clientApi->sendAsync($request,)->wait();
        return json_decode($res->getBody()) ;
    }

    /**
     * TODO : a tester
     * Delete or permanent delete a signature request (except in approval and ongoing status).
     * @param false $permanentDelete
     * @return mixed
     */
    public function delete($permanentDelete = false){
        $request = new Request('DELETE',"signature_requests/".$this->signatureRequestId . ($permanentDelete?"?".$permanent_delete=true:""), $this->headers);
        $res = $this->clientApi->sendAsync($request,)->wait();
        return json_decode($res->getBody()) ;
    }

    /***************************************/
    /** DOCUMENTS */
    /***************************************/

    /**
     * Ajout d'un document à ma SignRequet Yousign
     * @param Document $doc
     */
    public function addDocument( Document $doc ){


        echo("\r\n Ajout d'un document : " . $doc->getPathFile());

        //Création du multipart
        $docJson = $doc->toJson();
        foreach(json_decode( $docJson, true ) as $key => $value){
            $multipart[] = ['name' => $key,'contents' => $value];
        }

        $contents = file_get_contents(__DIR__ . $doc->getPathFile());
        echo( "\r\nCONTENT : " . $contents);

        //Ajout du fichier au multipart
        $multipart[] =     [
            'name' => 'file',
            'filename' => "test.pdf",
            'headers'  => [
                'Content-Type' => 'application/pdf'
            ],
            'contents' => $contents
        ];
        $options = [
            'multipart' => $multipart
        ];
        $headers = [
            //"accept" => "application/json",
            //"content-type" => "application/json",
            "Authorization" => "Bearer " . $this->apiKey
        ];
        $upload = null;
        var_dump($options);
        try {
            $requestApi = new Request('POST', $this->apiBaseUrl."signature_requests/".$this->getSignatureRequestId()."/documents",$headers);
            $res = $this->clientApi->sendAsync($requestApi, $options)->wait();
            $upload = $res->getBody();
        }catch (\Exception $exception){
             echo "\r\nERROR : " . $exception->getMessage();
        }

        /*$res = $this->clientApi->request("POST","/signature_requests/".$this->getSignatureRequestId()."/documents",);
        $upload = $res->getBody();*/

        var_dump($upload);
        $docId = json_decode( $upload )->id;
        $this->documentIds[] = $docId;

        return $docId;

    }

    /**
     * Liste les documents de ma SignRequest
     * @return mixed
     */
    public function listDocuments(): mixed
    {
        $request = new Request('GET', "signature_requests/".$this->signatureRequestId."/documents", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        $ret = json_decode($res->getBody()) ;

        return $ret;
    }

    /**
     * Si un seul doc le PDF est retourné, si plusieurs, le fichier est un zip.
     *
     * @param string $version
     * @param bool $archive
     * @return mixed
     */
    public function downloadSrDocuments(string $pathFileToSave,string $version = null, bool $archive = null)
    {
        $headers = [
            "accept" => "application/zip,application/pdf",
            "Authorization" => "Bearer " . $this->apiKey
        ];

        return $this->clientApi->request("GET", "signature_requests/".$this->signatureRequestId."/documents/download",[
            "headers" => $headers,
            'sink' => $pathFileToSave
        ] );
    }

    /**
     * Delete a document from a Signature Request in draft status.
     *
     * @param string $documentId
     * @return mixed
     */
    public function deleteDocument(string $documentId)
    {
        //$request = new Request('DELETE', "signature_requests/".$this->signatureRequestId."/documents/$documentId", $this->headers);

        $res = $this->clientApi->delete( "signature_requests/".$this->signatureRequestId."/documents/$documentId",[
            "headers" => $this->headers
        ]);


        return json_decode($res->getBody()) ;
    }

    /**
     * @param string $documentId
     * @return mixed
     */
    public function getDocument(string $documentId)
    {
        $res = $this->clientApi->get( "signature_requests/".$this->signatureRequestId."/documents/$documentId",[
            "headers" => $this->headers
        ]);
        return json_decode($res->getBody()) ;
    }

    /**
     * @param string $documentId
     * @param string $nature [attachment,signable_document]
     * @param string|null $insertAfterId
     * @param string|null $password
     * @param array|null $initialAreaObj
     * @return mixed
     */
    public function updateDocument(string $documentId, string $nature, string $insertAfterId = null, string $password = null, array $initialAreaObj = null)
    {
        $body =[
            "nature" => $nature,
            "insert_after_id" => $insertAfterId,
            "password" => $password,
            "initials" => $initialAreaObj,
        ];


        $res = $this->clientApi->patch( "signature_requests/".$this->signatureRequestId."/documents/$documentId",[
            "headers" => $this->headers,
            "json" => $body
        ]);
        return json_decode($res->getBody()) ;
    }

    /**
     * @param string $pathFileToSave
     * @param string $documentId
     * @return mixed
     */
    public function downloadDocument(string $documentId, string $pathFileToSave)
    {
        $headers = [
            "accept" => "application/zip,application/pdf",
            "Authorization" => "Bearer " . $this->apiKey
        ];

        return $this->clientApi->request("GET", "signature_requests/".$this->signatureRequestId."/documents/$documentId/download",[
            "headers" => $headers,
            'sink' => $pathFileToSave
        ] );
    }

    /**
     * Initialisation des docIds pour une signRequest
     */
    public function initDocuments(){
        $docs = $this->listDocuments();
        foreach ( $docs as $doc ){
            $this->documentIds[] = $doc->id;
        }
    }

    /***************************************/
    /** SIGNERS */
    /***************************************/

    public function addSigner(Signer $signer){
        $request = new Request('POST', "signature_requests/".$this->signatureRequestId."/signers", $this->headers, $signer->toJson());
        $res = $this->clientApi->sendAsync($request)->wait();
        $signerId = json_decode( $res->getBody() )->id;
        $this->signerIds[] = $signerId;

        return $this;
    }

    /**
     * Liste les signers de ma SignRequest
     * @return mixed
     */
    public function listSigners(): mixed
    {
        $request = new Request('GET', "signature_requests/".$this->signatureRequestId."/signers", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        $ret = json_decode($res->getBody()) ;

        return $ret;
    }

    /**
     * Delete a signer
     *
     * @param string $signerId
     * @return mixed
     */
    public function deleteSigner(string $signerId)
    {

        $response = $this->clientApi->request("DELETE", "signature_requests/".$this->signatureRequestId."/signers/$signerId", [
            'headers' => $this->headers,
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Get a signer
     *
     * @param string $signerId
     * @return mixed
     */
    public function getSigner(string $signerId)
    {
        $response = $this->clientApi->request('GET', "signature_requests/".$this->signatureRequestId."/signers/$signerId", [
            'headers' => $this->headers
        ]);

        return json_decode($response->getBody());
    }

    /**
     * Send a one-time password (OTP) to a specified Signer.
     * This endpoint is useful for integrating the signing flow into your application and allowing the Signer to sign through the API.
     * Once the OTP is sent, the Signer must provide it back to complete the Signature Request.
     *
     * @param string $signerId
     * @return mixed
     */
    public function sendOtpToSigner(string $signerId)
    {
        $response = $this->clientApi->request('POST', "signature_requests/".$this->signatureRequestId."/signers/$signerId/send_otp", [
            'headers' => $this->headers,
        ]);

        echo $response->getBody();
    }

    /**
     * To sign the Signature Request on behalf of the Signer you may have to ask for the Signer’s OTP
     * (only if the Signer has an authentication mode that requires one) in the signing flow you built to authenticate them.
     * Then you need to forward the OTP (if required), the date and time of their consent and the Signer IP address to Yousign
     *
     * @param string $signerId
     * @param array $body => https://developers.yousign.com/reference/post-signature_requests-signaturerequestid-signers-signerid-sign
     * @return mixed
     */
    public function sign(string $signerId, array $body)
    {
        $response = $this->clientApi->request("POST", "signature_requests/".$this->signatureRequestId."/signers/$signerId/sign", [
            "headers" => $this->headers,
            "json" => $body
        ]);

        echo $response->getBody();
    }

    /**
     * Initialisation des signers pour une signRequest
     */
    public function initSigners(){
        $signers = $this->listSigners();
        foreach ( $signers as $signer ){
            $this->signerIds[] = $signer->id;
        }
    }


    /***************************************/
    /** APPROVERS */
    /***************************************/
    /**
     * @param Approver $approver
     * @return mixed
     */
    public function addApprover(Approver $approver)
    {
        $request = new Request('POST', "signature_requests/".$this->signatureRequestId."/approvers", $this->headers, $approver->toJson());
        $res = $this->clientApi->sendAsync($request)->wait();
        $approverId = json_decode( $res->getBody() )->id;
        $this->approverIds[] = $approverId;
        return $this;
    }

    /**
     * @param string $approverId
     * @return mixed
     */
    public function deleteApprover(string $approverId)
    {
        $request = new Request('DELETE', "signature_requests/".$this->signatureRequestId."/approvers/$approverId", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        return json_decode($res->getBody()) ;
    }

    /**
     * @param string $approverId
     * @return mixed
     */
    public function getApprover(string $approverId)
    {
        $request = new Request('GET', "signature_requests/".$this->signatureRequestId."/approvers/$approverId", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        return json_decode($res->getBody()) ;
    }

    /**
     * @param string $approverId
     * @param Approver $approver
     * @return mixed
     */
    public function updateApprover(string $approverId, Approver $approver)
    {
        $request = new Request('PATCH', "signature_requests/".$this->signatureRequestId."/approvers/$approverId", $this->headers, $approver->toJson());
        $res = $this->clientApi->sendAsync($request)->wait();
        return json_decode($res->getBody()) ;
    }

    /***************************************/
    /** FOLLOWERS */
    /***************************************/

    /**
     * @return mixed
     */
    public function listFollowers()
    {
        $body =  $this->clientApi->request("GET", "signature_requests/".$this->signatureRequestId."/followers",[
            "headers" => $this->headers
        ] )->getBody();

        return json_decode( $body);
    }

    /**
     * @param string $email
     * @param string $locale
     * @return mixed
     */
    public function addFollower(string $email, string $locale = "fr")
    {
        $this->clientApi->request("POST", "signature_requests/".$this->signatureRequestId."/followers",[
            "headers" => $this->headers,
            "json" => [[
                "email" => $email,
                "locale" => $locale
            ]]
        ] );

        return $this;
    }

    /***************************************/
    /** METADATA */
    /***************************************/

    /**
     * Delete the Metadatas for my Sign Request
     * @return mixed
     */
    public function deleteMetadata()
    {
        $response = $this->clientApi->request('DELETE', "signature_requests/".$this->signatureRequestId."/metadata", [
            'headers' => $this->headers,
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * Get the Metadatas for my Sign Request
     * @return mixed
     */
    public function getMetadata()
    {
        $response = $this->clientApi->request('GET', "signature_requests/".$this->signatureRequestId."/metadata", [
            'headers' => $this->headers,
        ]);

        return json_decode( $response->getBody() );
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function addMetadata(array $data)
    {
        $this->clientApi->request('POST', "signature_requests/".$this->signatureRequestId."/metadata", [
            'headers' => $this->headers,
            "json" =>  [
                "data" => $data
            ]
        ]);

        return $this;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateMetadata(array $data)
    {
        $this->clientApi->request('PUT', "signature_requests/".$this->signatureRequestId."/metadata", [
            'headers' => $this->headers,
            "json" =>  [
                "data" => $data
            ]
        ]);

        return $this;
    }

    /***************************************/
    /** AUDIT TRAIL */
    /***************************************/

    /**
     * @param string $signerId
     * @return mixed
     */
    public function downloadSignerAuditTrail(string $signerId, string $pathFileToSave)
    {
        $headers = [
            "accept" => "application/pdf",
            "Authorization" => "Bearer " . $this->apiKey
        ];

        return $this->clientApi->request("GET", "signature_requests/".$this->signatureRequestId."/signers/$signerId/audit_trails/download",[
            "headers" => $headers,
            'sink' => $pathFileToSave
        ] );



//
//        $headers = [
//            "accept" => "application/pdf",
//            "Authorization" => "Bearer " . $this->apiKey
//        ];
//        $request = new Request('GET', "signature_requests/".$this->signatureRequestId."/signers/$signerId/audit_trails/download", $headers);
//        $res = $this->clientApi->sendAsync($request)->wait();
//        return $res->getBody() ;
    }

    /**
     * @param string $signerId
     * @return mixed
     */
    public function getSignerAuditTrail(string $signerId)
    {
        $request = new Request('GET', "signature_requests/".$this->signatureRequestId."/signers/$signerId/audit_trails", $this->headers);
        $res = $this->clientApi->sendAsync($request)->wait();
        return json_decode($res->getBody()) ;
    }

    /**
     * @return mixed
     */
    public function downloadSrAuditTrail(string $pathFileToSave)
    {
        $headers = [
            "accept" => "application/zip,application/pdf",
            "Authorization" => "Bearer " . $this->apiKey
        ];

        return $this->clientApi->request("GET", "signature_requests/".$this->signatureRequestId."/audit_trails/download",[
            "headers" => $headers,
            'sink' => $pathFileToSave
        ] );
    }

    /**
     * @return mixed
     */
    public function getSignatureRequestId()
    {
        return $this->signatureRequestId;
    }

    /**
     * @return mixed
     */
    public function getSignatureRequestName()
    {
        return $this->signatureRequestName;
    }

    /**
     * @return array
     */
    public function getDocumentIds(): array
    {
        return $this->documentIds;
    }

    public function getLastDocumentId(){
        //return end($this->documentIds);
        return $this->documentIds[array_key_last($this->documentIds)];
    }

    /**
     * @return array
     */
    public function getSignerIds(): array
    {
        return $this->signerIds;
    }

    /**
     * @return array
     */
    public function getApproverIds(): array
    {
        return $this->approverIds;
    }



}
