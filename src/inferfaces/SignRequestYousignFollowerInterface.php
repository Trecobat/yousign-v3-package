<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;
use Trecobat\YousignV3Package\Model\Document;
use Trecobat\YousignV3Package\SignRequestYousign;

interface SignRequestYousignFollowerInterface
{
    /**
     * List follower on Signature Request*
     *
     * @return mixed
     */
    public function listFollowers();

    /**
     * Create new followers on my Signature Request
     *
     * @param string $email
     * @param string $locale
     * @return SignRequestYousign
     */
    public function addFollower(string $email, string $locale = "fr");


}
