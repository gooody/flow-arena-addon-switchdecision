<?php
namespace FlowArenaModule\SwitchDecision\Handlers;

use App\Common\AddOns\Contracts\HandlerInterface;
use App\Common\AddOns\Contracts\StepProcessingContextInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Implements switch-case logic to evaluate conditions and route 
 * execution to the appropriate automation branch.
 * 
 * Class SwitchDecisionHandler
 * @package FlowArenaModule\SwitchDecision
 */
class SwitchDecisionHandler implements HandlerInterface
{

    public function execute(StepProcessingContextInterface $stepProcessingContext) :void
    {
        $el = new ExpressionLanguage();

        $options = $stepProcessingContext->getOptions();
        $data = $stepProcessingContext->getData();
        
        $elVars = [
            ...$data,
            'expression' => $el->evaluate($options['expression'], $data),
            'map' => [
            ]
        ];

        foreach ($options['caseExpressions'] AS $caseKey => $caseItem) {
            if (
                empty($caseItem)
                || isset($elVars['map'][$caseItem])
            ) {
                continue;
            }

            $caseItemCalculated = $el->evaluate($caseItem, $data);
            $elVars['map'][$caseItemCalculated] = $caseKey;
        }

        $eventKey = $el->evaluate('map[expression] ?? "default"', $elVars);
        
        $stepProcessingContext->busPublish(
            $stepProcessingContext->getData(), 
            $eventKey
        );

    }

}