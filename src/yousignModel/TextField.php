<?php

namespace Trecobat\YousignV3Package\Model;

class TextField extends SignerField
{
    public int $maxLength;
    public string $question;
    public string $instruction;
    public bool $optional;

    public function __construct( string $document_id, int $height, int $width, int $page, int $x, int $y,int $maxLength,string $question,string $instruction,bool $optional)
    {
        parent::__construct("text", $document_id, $height, $width, $page, $x, $y);
        $this->maxLength = $maxLength;
        $this->question = $question;
        $this->instruction = $instruction;
        $this->optional = $optional;
    }

}
