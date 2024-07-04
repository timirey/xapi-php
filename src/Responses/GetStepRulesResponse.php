<?php

namespace Timirey\XApi\Responses;

use Timirey\XApi\Responses\Data\StepRecord;
use Timirey\XApi\Responses\Data\StepRuleRecord;

/**
 * Class that contains the response of the getStepRules command.
 */
class GetStepRulesResponse extends AbstractResponse
{
    /**
     * Constructor for GetStepRulesResponse.
     *
     * @param  StepRuleRecord[]  $stepRuleRecords  StepRuleRecord instances.
     */
    public function __construct(public array $stepRuleRecords)
    {
    }

    /**
     * Create a response instance from the validated data.
     *
     * @param  array  $data  Validated response data.
     * @return static Instance of the response.
     */
    protected static function create(array $data): static
    {
        return new static(array_map(
            static fn (array $stepRuleRecordData): StepRuleRecord => new StepRuleRecord(
                $stepRuleRecordData['id'],
                $stepRuleRecordData['name'],
                array_map(
                    static fn (array $stepRecordData): StepRecord => new StepRecord(...$stepRecordData),
                    $stepRuleRecordData['steps']
                )
            ),
            $data['returnData']
        ));
    }
}
