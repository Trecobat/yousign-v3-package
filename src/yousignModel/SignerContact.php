<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Construction d'un SIGNER à partir d'un CONTACT
 */
class SignerContact extends Signer
{
    public string $contact_id = "";


    public function __construct(string $contact_id){
        parent::__construct();
        $this->contact_id = $contact_id;
    }
}
