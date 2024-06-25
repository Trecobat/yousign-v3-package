<?php

namespace Trecobat\YousignV3Package\Model;

abstract class YousignModelApi
{
    /**
     * Retourne le model sous forme de JSON
     * @return false|string
     */
    public function toJson(){
        return json_encode($this);
    }

}
