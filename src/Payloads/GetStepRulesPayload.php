<?php

namespace Timirey\XApi\Payloads;

use Override;

/**
 * Class that contains payload for the getStepRules command.
 */
final class GetStepRulesPayload extends AbstractPayload
{
    /**
     * @inheritdoc
     */
    #[Override]
    protected function getCommand(): string
    {
        return 'getStepRules';
    }
}
