<?php

namespace Trecobat\YousignV3Package\Model;

use Trecobat\YousignV3Package\Model\YousignModelApi;

class SignatureRequestEmailNotification extends YousignModelApi
{
    /**
     * Sender of the notification
     * -> Type ['workspace','organisation','custom']
     * -> custom_name To use in association with sender type custom to precise the name
     * @var array
     */
    public $sender;

    /**
     * Custom note to add to the notification
     *
     * @var string
     */
    public $custom_note;

    /**
     * @param array $sender
     * @param array $custom_note
     */
    public function __construct(string $typeSender, string $customNameSender = null, string $custom_note = null)
    {
        $this->sender = ["type" => $typeSender,"custom_name" => $customNameSender];
        $this->custom_note = $custom_note;
    }


    /**
     * @return string
     */
    public function getCustomNote(): string
    {
        return $this->custom_note;
    }

    /**
     * @return array
     */
    public function getSender(): array
    {
        return $this->sender;
    }

}
