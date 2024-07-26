<?php

namespace Timirey\XApi\Payloads;

use Override;
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
    #[Override]
    public function getCommand(): string
    {
        return 'getStepRules';
    }
}
