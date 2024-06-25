<?php

namespace Trecobat\YousignV3Package\Interfaces;

use Trecobat\YousignV3Package\Model\Approver;

interface SignRequestYousignApproverInterface
{
    public function addApprover(Approver $approver);
    public function deleteApprover(string $approverId);
    public function getApprover(string $approverId);
    public function updateApprover(string $approverId, Approver $approver);
}
