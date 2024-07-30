<?php

namespace Timirey\XApi\Responses;

use Override;
use Timirey\XApi\Responses\Data\StepRecord;
use Timirey\XApi\Responses\Data\StepRuleRecord;

/**
 * Class that contains the response of the getStepRules command.
 */
final readonly class GetStepRulesResponse extends AbstractResponse
{
    /**
     * Constructor for GetStepRulesResponse.
     *
     * @param  StepRuleRecord[] $stepRuleRecords StepRuleRecord instances.
     */
    public function __construct(public array $stepRuleRecords)
    {
    }

    /**
     * @inheritdoc
     */
    #[Override]
    protected static function create(array $response): self
    {
        return new self(array_map(
            static fn (array $stepRuleRecordData): StepRuleRecord => new StepRuleRecord(
                $stepRuleRecordData['id'],
                $stepRuleRecordData['name'],
                array_map(
                    static fn (array $stepRecordData): StepRecord => new StepRecord(...$stepRecordData),
                    $stepRuleRecordData['steps']
                )
            ),
            $response
        ));
    }
}
