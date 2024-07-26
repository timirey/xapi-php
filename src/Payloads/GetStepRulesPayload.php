<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Enums\Day;

/**
 * Class that contains payload for the getStepRules command.
 */
final class GetStepRulesPayload extends AbstractPayload
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
