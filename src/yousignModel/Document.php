<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * Documents
 * PDF files that can be added to Signature Requests.
 *
 * A Document is a signable_document if it is going to be signed by Signers (ex: a contract).
 * On the contrary, an attachment is not meant to be signed, but rather just added to the Signature Request (ex: annexes).
 */
class Document extends YousignModelApi
{
//    /**
//     * Path of the file  to add
//     * @var string $pathFile
//     */
//    private string $pathFile = "";
//
//    private string $fileName;
//
//    /**
//     * @var string $nature
//     */
//    public string $nature = "";
//
//    /**
//     * insert just after the position of the specified document id
//     * @var string $insert_after_id
//     */
//    public string $insert_after_id;
//
//    /**
//     * @var string $password
//     */
//    public string $password;
//
//    /**
//     * @var object $initials
//     */
//    public object $initials;
//
//    /**
//     * @var string $parse_anchors
//     */
//    public string $parse_anchors;

    /**
     * Path of the file  to add
     * @var string $pathFile
     */
    private $pathFile = "";

    private $fileName;

    /**
     * @var string $nature
     */
    public $nature = "";

    /**
     * insert just after the position of the specified document id
     * @var string $insert_after_id
     */
    public $insert_after_id;

    /**
     * @var string $password
     */
    public $password = null;

    /**
     * @var object $initials
     */
    public $initials = null;

    /**
     * @var string $parse_anchors
     */
    public $parse_anchors = "false";

    public function __construct($pathFile, $fileName, $nature = "signable_document")
    {
        $this->pathFile = $pathFile;
        $this->fileName = $fileName;
        $this->nature = $nature;
    }

    /**
     * @return string
     */
    public function getPathFile(): string
    {
        return $this->pathFile;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getNature(): mixed
    {
        return $this->nature;
    }

    /**
     * @return string
     */
    public function getInsertAfterId(): string
    {
        return $this->insert_after_id;
    }

    /**
     * @param string $insert_after_id
     */
    public function setInsertAfterId(string $insert_after_id): void
    {
        $this->insert_after_id = $insert_after_id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return object
     */
    public function getInitials(): object
    {
        return $this->initials;
    }

    /**
     * @param object $initials
     */
    public function setInitials(object $initials): void
    {
        $this->initials = $initials;
    }

    /**
     * @return bool
     */
    public function isParseAnchors(): bool
    {
        if( $this->parse_anchors == "true" ){
            return true;
        }

        return false;
    }

    /**
     * @param bool $parse_anchors
     */
    public function setParseAnchors(bool $parse_anchors): void
    {
        if($parse_anchors){
            $this->parse_anchors = "true";
        }else{
            $this->parse_anchors = "false";
        }
        //$this->parse_anchors = $parse_anchors;
    }

    /**
     * Retourne le model sous forme de JSON
     * @return false|string
     */
    public function toJson(){
        if( $this->insert_after_id == null ){
            unset($this->insert_after_id);
        }
        if( $this->password == null ){
            unset($this->password);
        }
        if( $this->initials == null ){
            unset($this->initials);
        }
        return parent::toJson();
    }


}
