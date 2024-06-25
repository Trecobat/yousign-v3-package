<?php

namespace Trecobat\YousignV3Package\Model;

class ApproverInfo extends Approver
{
    public array $info;

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone_number
     */
    public function __construct(string $first_name, string $last_name, string $email, string $phone_number = null)
    {
        //parent::__construct();
        $this->info['first_name'] = $first_name;
        $this->info['last_name'] = $last_name;
        $this->info['email'] = $email;
        if($phone_number){
            $this->info['phone_number'] = $phone_number;
        }
        $this->info['locale'] = "fr";
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
