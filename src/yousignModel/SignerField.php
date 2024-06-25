<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Construction d'un SIGNER FIELD
 */
abstract class SignerField extends YousignModelApi
{
    /**
     * ['signature','']
     * @var string
     */
    public string $type;
    public string $document_id;
    public int $height;
    public int $width;
    public int $page;
    public int $x;
    public int $y;

    /**
     * @param string $type
     * @param string $document_id
     * @param int $height
     * @param int $width
     * @param int $page
     * @param int $x
     * @param int $y
     */
    public function __construct(string $type, string $document_id, int $height, int $width, int $page, int $x, int $y)
    {
        $this->type = $type;
        $this->document_id = $document_id;
        $this->height = $height;
        $this->width = $width;
        $this->page = $page;
        $this->x = $x;
        $this->y = $y;
    }


}
