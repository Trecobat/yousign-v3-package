<?php

namespace Trecobat\YousignV3Package\Model;

class CheckboxField extends SignerField
{
    public string $name;
    public bool $optional;
    public bool $checked;
    public int $size;

    public function __construct( string $document_id,  int $page, int $x, int $y, string $name, bool $optional, bool $checked, int $size)
    {
        parent::__construct("checkbox", $document_id, null, null, $page, $x, $y);
        $this->name = $name;
        $this->optional = $optional;
        $this->checked = $checked;
        $this->size = $size;

    }

}
