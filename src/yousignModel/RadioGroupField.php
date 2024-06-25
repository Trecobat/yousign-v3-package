<?php

namespace Trecobat\YousignV3Package\Model;

class RadioGroupField extends SignerField
{
    public string $name;
    public bool $optional;
    public array $radios;

    public function __construct( string $document_id,  int $page, string $name, bool $optional)
    {
        parent::__construct("radio_group", $document_id, null, null, $page, null, null);
        $this->name = $name;
        $this->optional = $optional;
    }

    public function addRadios(string $name, int $x, int $y, int $size){
        $this->radios[] = [
            "name" => $name,
            "x" => $x,
            "y" => $y,
            "size" => $size,
        ];

        return $this;
    }

}
