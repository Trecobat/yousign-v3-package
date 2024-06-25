<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;

interface SignRequestYousignDocumentInterface
{
    /**
     * List signature request documents
     * @return mixed
     */
    public function listDocuments();

    /**
     * Add document to a signature request
     * @param Document $doc
     * @return mixed
     */
    public function addDocument(Document $doc);

    /**
     * Download signature request documents
     * @param string $version
     * @param bool $archive
     * @return mixed
     */
    public function downloadSrDocuments(string $pathFileToSave, string $version = null,bool $archive = null);

    /**
     * Delete a document from a Signature Request in draft status
     *
     * @param string $documentId
     * @return mixed
     */
    public function deleteDocument(string $documentId);

    /**
     * @param string $documentId
     * @return mixed
     */
    public function getDocument(string $documentId);

    /**
     * Update a document
     *
     * @param string $documentId
     * @param string $nature
     * @param string|null $insertAfterId
     * @param string|null $password
     * @param array|null $initialAreaObj
     * @return mixed
     */
    public function updateDocument(string $documentId,string $nature, string $insertAfterId = null, string $password = null, array $initialAreaObj = null );

    /**
     * @param string $pathFileToSave
     * @param string $documentId
     * @return mixed
     */
    public function downloadDocument(string $documentId, string $pathFileToSave);



}
