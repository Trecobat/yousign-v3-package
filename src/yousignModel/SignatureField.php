<?php

namespace Trecobat\YousignV3Package\Model;

class SignatureField extends SignerField
{
    public function __construct( string $document_id, int $height, int $width, int $page, int $x, int $y)
    {
        parent::__construct("signature", $document_id, $height, $width, $page, $x, $y);
    }

}
