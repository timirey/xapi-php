<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getStepRules command.
 */
class GetStepRulesPayload extends AbstractPayload
{
    /**
     * {@inheritdoc}
     */
    public function getCommand(): string
    {
        return 'getStepRules';
    }
}
