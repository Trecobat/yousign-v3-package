<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Construction d'un SIGNER à partir des ses infos
 */
class SignerInfo extends Signer
{
    public array $info = [];


    public function __construct($first_name,$last_name,$email,$phone_number,$local = "fr"){
        parent::__construct();
        $this->info["first_name"] = $first_name;
        $this->info["last_name"] = $last_name;
        $this->info["email"] = $email;
        $this->info["phone_number"] = $phone_number;
        $this->info["locale"] = $local;
    }
}
