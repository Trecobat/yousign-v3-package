<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;
use Trecobat\YousignV3Package\SignRequestYousign;

interface SignRequestYousignMetadataInterface
{

    /**
     * Delete the Metadatas for my Sign Request
     * @return mixed
     */
    public function deleteMetadata();

    /**
     * Get the Metadatas for my Sign Request
     * @return mixed
     */
    public function getMetadata();

    /**
     * @param array $data
     * @return mixed
     */
    public function addMetadata(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function updateMetadata(array $data);


}
