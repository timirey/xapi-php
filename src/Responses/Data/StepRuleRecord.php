<?php

namespace Timirey\XApi\Responses\Data;

/**
 * Class representing a step rule record.
 */
final readonly class StepRuleRecord
{
    /**
     * Constructor for StepRuleRecord.
     *
     * @param  integer      $id          Step rule ID.
     * @param  string       $name        Step rule name.
     * @param  StepRecord[] $stepRecords Array of STEP_RECORD.
     */
    public function __construct(public int $id, public string $name, public array $stepRecords)
    {
    }
}
