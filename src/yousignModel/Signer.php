<?php

namespace Trecobat\YousignV3Package\Model;


/**
 * Signers
 * The individuals you are asking to sign the Documents (signable_document).
 */
abstract class Signer extends YousignModelApi
{
/*    //public SignatureLevelEnum $signature_level;
    public string $signature_level;
    public array $fields;
    public string $insert_after_id;
    //public SignatureAuthModeEnum $signature_authentication_mode;
    public string $signature_authentication_mode; //
    public array $redirect_urls;
    public array $custom_text;
    //public DeliveryModeEnum $delivery_mode;
    public string $delivery_mode;*/

    //public SignatureLevelEnum $signature_level;
    public $signature_level;
    public $fields;
    public $insert_after_id;
    //public SignatureAuthModeEnum $signature_authentication_mode;
    public $signature_authentication_mode; //
    public $redirect_urls;
    public $custom_text;
    //public DeliveryModeEnum $delivery_mode;
    public $delivery_mode;

    public $email_notification;

    public function __construct()
    {
        //$this->signature_level = SignatureLevelEnum::electronic_signature;
        $this->signature_level = "electronic_signature";
        //$this->signature_authentication_mode  = SignatureAuthModeEnum::no_otp;
        $this->signature_authentication_mode  = "otp_sms";
        $this->delivery_mode  = "email";
    }

    public function addField(SignerField $field){
        $this->fields[] = $field;
        return $this;
    }

    /**
     * @param string SignatureLevelEnum
     * ['electronique_signature','advanced_electronic_signature','electronic_signature_with_qualified_certificate','qualified_electronic_signature','qualified_electronic_signature_mode_1']
     */
    public function setSignatureLevel(string $signature_level): void
    {
        $this->signature_level = $signature_level;
    }

    /**
     * @param string $insert_after_id
     */
    public function setInsertAfterId(string $insert_after_id): void
    {
        $this->insert_after_id = $insert_after_id;
    }

    /**
     * @param string $signature_authentication_mode
     * ["otp_email","otp_sms","no_otp"]
     */
    public function setSignatureAuthenticationMode(string $signature_authentication_mode): void
    {
        $this->signature_authentication_mode = $signature_authentication_mode;
    }

    /**
     * @param string $redirect_urls
     */
    public function setRedirectUrlSucces(string $uri): void
    {
        $this->redirect_urls["success"] = $uri;
    }

    /**
     * @param string $redirect_urls
     */
    public function setRedirectUrlError(string $uri): void
    {
        $this->redirect_urls["error"] = $uri;
    }

    /**
     * @param string $request_subject
     * @param string $request_body
     */
    public function setCustomTextRequest(string $request_subject,string $request_body ): void
    {
        $this->custom_text["request_subject"] = $request_subject;
        $this->custom_text["request_body"] = $request_body;
    }

    /**
     * @param string $reminder_subject
     * @param string $reminder_body
     */
    public function setCustomTextReminder(string $reminder_subject,string $reminder_body ): void
    {
        $this->custom_text["reminder_subject"] = $reminder_subject;
        $this->custom_text["reminder_body"] = $reminder_body;
    }

    /**
     * @param string $delivery_mode
     * ["email","none"]
     */
    public function setDeliveryMode(string $delivery_mode): void
    {
        $this->delivery_mode = $delivery_mode;
    }

    /**
     * @return mixed
     */
    public function getEmailNotification()
    {
        return $this->email_notification;
    }

    /**
     * @param mixed $email_notification
     */
    public function setEmailNotification($email_notification): void
    {
        $this->email_notification = $email_notification;
    }

    public function addEmailNotificationDisabled($notif): void
    {
        $this->email_notification->disabled[] = $notif;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return  "\r\n\tsignature_level => " . $this->signature_level .
                ", fields => " . json_encode($this->fields??[]) .
                "\r\n\t, insert_after_id => " . ($this->insert_after_id??null) .
                ", signature_authentication_mode => " . $this->signature_authentication_mode .
                "\r\n\t, redirect_urls => " . json_encode( $this->redirect_urls??[] ) .
                ", custom_text => " . json_encode($this->custom_text??[] ).
                ", delivery_mode => " . $this->delivery_mode;

    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        if($this->insert_after_id == null){
            unset($this->insert_after_id);
        }
        return parent::toJson();
    }

}
