<?php

namespace Timirey\XApi\Payloads;

/**
 * Class that contains payload for the getStepRules command.
 */
class GetStepRulesPayload extends AbstractPayload
{
    /**
     * Get the command.
     *
     * @return string Command name.
     */
    public function getCommand(): string
    {
        return 'getStepRules';
    }
}
