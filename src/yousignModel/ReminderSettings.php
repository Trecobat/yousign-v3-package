<?php

namespace Trecobat\YousignV3Package\Model;

use Trecobat\YousignV3Package\Model\YousignModelApi;

class ReminderSettings extends YousignModelApi
{
    public int $interval_in_days;
    public int $max_occurrences;

    public function __construct(int $interval_in_days, int $max_occurrences = 1)
    {
        $this->interval_in_days = $interval_in_days;
        $this->max_occurrences = $max_occurrences;
    }

    /**
     * @return int
     */
    public function getIntervalInDays(): int
    {
        return $this->interval_in_days;
    }

    /**
     * @return int
     */
    public function getMaxOccurrences(): int
    {
        return $this->max_occurrences;
    }

    /**
     * @param int $interval_in_days
     */
    public function setIntervalInDays(int $interval_in_days): void
    {
        $this->interval_in_days = $interval_in_days;
    }

    /**
     * @param int $max_occurrences
     */
    public function setMaxOccurrences(int $max_occurrences): void
    {
        $this->max_occurrences = $max_occurrences;
    }
}
