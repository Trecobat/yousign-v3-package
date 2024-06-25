<?php

namespace Trecobat\YousignV3Package\Model;

class MentionField extends SignerField
{
    public string $mention;

    public function __construct( string $document_id, string $height, int $width, int $page, int $x, int $y, string $mention)
    {
        parent::__construct("mention", $document_id, $height, $width, $page, $x, $y);
        $this->mention = $mention;

    }

}
