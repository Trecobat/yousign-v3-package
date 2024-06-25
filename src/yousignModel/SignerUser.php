<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Construction d'un SIGNER à partir d'un USER
 */
class SignerUser extends Signer
{
    public string $user_id = "";


    public function __construct(string $user_id){
        parent::__construct();
        $this->user_id = $user_id;
    }
}
