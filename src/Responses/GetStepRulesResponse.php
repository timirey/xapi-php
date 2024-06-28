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
     * @param StepRuleRecord[] $stepRuleRecords
     */
    public function __construct(public array $stepRuleRecords)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $stepRulesRecords = array_map(function ($stepRuleRecordData) {
            return new StepRuleRecord(
                $stepRuleRecordData['id'],
                $stepRuleRecordData['name'],
                array_map(function ($stepRecordData) {
                    return new StepRecord(...$stepRecordData);
                }, $stepRuleRecordData['steps'])
            );
        }, $data['returnData']);

        return new static($stepRulesRecords);
    }
}
