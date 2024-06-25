<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;

interface SignRequestYousignAuditTrailInterface
{
    public function downloadSignerAuditTrail(string $signerId,string $pathFileToSave);
    public function getSignerAuditTrail(string $signerId);
    public function downloadSrAuditTrail(string $pathFileToSave);
}
