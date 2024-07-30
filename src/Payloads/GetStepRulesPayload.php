<?php

namespace Timirey\XApi\Payloads;

use Override;

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
    protected function getCommand(): string
    {
        return 'getStepRules';
    }
}
