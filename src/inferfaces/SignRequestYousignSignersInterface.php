<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;
use Trecobat\YousignV3Package\Model\Signer;
use Trecobat\YousignV3Package\SignRequestYousign;

interface SignRequestYousignSignersInterface
{
    /**
     * List signers from a signature request
     *
     * @return mixed
     */
    public function listSigners();

    /**
     * Create a new signer
     *
     * @param Signer $signer
     * @return mixed
     */
    public function addSigner(Signer $signer);

    /**
     * Delete a signer
     *
     * @param string $signerId
     * @return mixed
     */
    public function deleteSigner(string $signerId);

    /**
     * Get a signer
     *
     * @param string $signerId
     * @return mixed
     */
    public function getSigner(string $signerId);

    /**
     * Send a one-time password (OTP) to a specified Signer.
     * This endpoint is useful for integrating the signing flow into your application and allowing the Signer to sign through the API.
     * Once the OTP is sent, the Signer must provide it back to complete the Signature Request.
     *
     * @param string $signerId
     * @return mixed
     */
    public function sendOtpToSigner(string $signerId);

    /**
     * To sign the Signature Request on behalf of the Signer you may have to ask for the Signer’s OTP
     * (only if the Signer has an authentication mode that requires one) in the signing flow you built to authenticate them.
     * Then you need to forward the OTP (if required), the date and time of their consent and the Signer IP address to Yousign
     *
     * @param string $signerId
     * @param array $body => https://developers.yousign.com/reference/post-signature_requests-signaturerequestid-signers-signerid-sign
     * @return mixed
     */
    public function sign(string $signerId, array $body );



}
