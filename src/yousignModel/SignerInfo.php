<?php

namespace Trecobat\YousignV3Package\Model;

use Illuminate\Support\Str;

/**
 * Construction d'un SIGNER à partir des ses infos
 */
class SignerInfo extends Signer
{
    public $info = [];


    public function __construct($first_name,$last_name,$email,$phone_number,$local = "fr"){
        parent::__construct();
        if( Str::startsWith($phone_number,0)){
            $phone_number = Str::replaceFirst("0","+33",$phone_number);
        }
        $this->info["first_name"] = $first_name;
        $this->info["last_name"] = $last_name;
        $this->info["email"] = $email;
        $this->info["phone_number"] = $phone_number;
        $this->info["locale"] = $local;
    }

    public function __toString(): string
    {
        return "SignerInfo [[ infos  => " . json_encode( $this->info ) .
            parent::__toString() .
            " ]]";
    }
}
