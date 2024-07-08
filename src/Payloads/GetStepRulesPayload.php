<?php

namespace Timirey\XApi\Payloads;

use Timirey\XApi\Enums\Day;

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
        $a = Day::TUESDAY;

        return 'getStepRules';
    }
}
