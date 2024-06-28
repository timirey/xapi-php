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
     * @param StepRuleRecord[] $stepRules
     */
    public function __construct(public array $stepRules)
    {
    }

    /**
     * @inheritdoc
     */
    protected static function create(array $data): static
    {
        $stepRules = array_map(function ($stepRuleData) {
            return new StepRuleRecord(
                $stepRuleData['id'],
                $stepRuleData['name'],
                array_map(function ($stepData) {
                    return new StepRecord(...$stepData);
                }, $stepRuleData['steps'])
            );
        }, $data['returnData']);

        return new static($stepRules);
    }
}
