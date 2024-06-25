<?php

namespace Trecobat\YousignV3Package\Model;

/**
 *
 * Signature Request
 * This is the core resource of the Yousign API. A Signature Request represents the object that you send to a recipient to sign. A Signature Request can have one or many Documents and one or many Signers.
 *
 * There are three different levels of electronic signature (eSignature):
 *
 * Simple eSignature, useful for online signatures for your daily work
 * Advanced eSignature, to secure signatures for your sensitive documents
 * Qualified eSignature, which is the legal equivalent of a handwritten signature
 * Signature requests can have different statuses, according to their state of completion.
 */
class SignatureRequest extends YousignModelApi
{
    /**
     * @var string Name of the signature request
     */
    public string $name = "";

    /**
     * @var string Delivery mode to notify signers. ['none','email']
     */
    public string $delivery_mode = "email";
    public bool $ordered_signers;
    public object|null $reminder_settings;
    public string $expiration_date;
    public string $template_id;
    public string|null $external_id;
    public string|null $custom_experience_id;
    public string|null $workspace_id;
    public string|null $audit_trail_locale;
    public bool $signers_allowed_to_decline;
    public SignatureRequestEmailNotification|null $email_notification;
    public object|null $template_placeholders;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDeliveryMode(): string
    {
        return $this->delivery_mode;
    }

    /**
     * @param string $delivery_mode
     */
    public function setDeliveryMode(string $delivery_mode): void
    {
        $this->delivery_mode = $delivery_mode;
    }

    /**
     * @return bool
     */
    public function isOrderedSigners(): bool
    {
        return $this->ordered_signers;
    }

    /**
     * @param bool $ordered_signers
     */
    public function setOrderedSigners(bool $ordered_signers): void
    {
        $this->ordered_signers = $ordered_signers;
    }

    /**
     * @return object|null
     */
    public function getReminderSettings(): ?object
    {
        return $this->reminder_settings;
    }

    /**
     * @param object|null $reminder_settings
     */
    public function setReminderSettings(?object $reminder_settings): void
    {
        $this->reminder_settings = $reminder_settings;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->expiration_date;
    }

    /**
     * @param string $expiration_date
     */
    public function setExpirationDate(string $expiration_date): void
    {
        $this->expiration_date = $expiration_date;
    }

    /**
     * @return string
     */
    public function getTemplateId(): string
    {
        return $this->template_id;
    }

    /**
     * @param string $template_id
     */
    public function setTemplateId(string $template_id): void
    {
        $this->template_id = $template_id;
    }

    /**
     * @return string|null
     */
    public function getExternalId(): ?string
    {
        return $this->external_id;
    }

    /**
     * @param string|null $external_id
     */
    public function setExternalId(?string $external_id): void
    {
        $this->external_id = $external_id;
    }

    /**
     * @return string|null
     */
    public function getCustomExperienceId(): ?string
    {
        return $this->custom_experience_id;
    }

    /**
     * @param string|null $custom_experience_id
     */
    public function setCustomExperienceId(?string $custom_experience_id): void
    {
        $this->custom_experience_id = $custom_experience_id;
    }

    /**
     * @return string|null
     */
    public function getWorkspaceId(): ?string
    {
        return $this->workspace_id;
    }

    /**
     * @param string|null $workspace_id
     */
    public function setWorkspaceId(?string $workspace_id): void
    {
        $this->workspace_id = $workspace_id;
    }

    /**
     * @return string|null
     */
    public function getAuditTrailLocale(): ?string
    {
        return $this->audit_trail_locale;
    }

    /**
     * @param string|null $audit_trail_locale
     */
    public function setAuditTrailLocale(?string $audit_trail_locale): void
    {
        $this->audit_trail_locale = $audit_trail_locale;
    }

    /**
     * @return bool
     */
    public function isSignersAllowedToDecline(): bool
    {
        return $this->signers_allowed_to_decline;
    }

    /**
     * @param bool $signers_allowed_to_decline
     */
    public function setSignersAllowedToDecline(bool $signers_allowed_to_decline): void
    {
        $this->signers_allowed_to_decline = $signers_allowed_to_decline;
    }

    /**
     * @return SignatureRequestEmailNotification|null
     */
    public function getEmailNotification(): ?SignatureRequestEmailNotification
    {
        return $this->email_notification;
    }

    /**
     * @param object|null $email_notification
     */
    public function setEmailNotification(SignatureRequestEmailNotification $email_notification): void
    {
        $this->email_notification = $email_notification;
    }

    /**
     * @return object|null
     */
    public function getTemplatePlaceholders(): ?object
    {
        return $this->template_placeholders;
    }

    /**
     * @param object|null $template_placeholders
     */
    public function setTemplatePlaceholders(?object $template_placeholders): void
    {
        $this->template_placeholders = $template_placeholders;
    }






}
