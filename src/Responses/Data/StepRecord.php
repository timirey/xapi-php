<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a step record.
 */
class StepRecord
{
    /**
     * Constructor for StepRecord.
     *
     * @param  float $fromValue Lower border of the volume range.
     * @param  float $step      Lot step value in the given volume range.
     */
    public function __construct(public float $fromValue, public float $step)
    {
    }
}
