<?php

namespace Trecobat\YousignV3Package\Model;

/**
 * APPROVERS
 *
 * Any person who needs to validate the content of a Signature Request before it can be signed, including the content of
 * the document and the information (first name, last name, email address, etc.) of the signers.
 *
 * It can be, for example, a manager or a member of the legal department.
 */
abstract class Approver extends YousignModelApi
{
}
