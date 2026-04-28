<?php

namespace FlowArenaModule\SwitchDecision;

use App\Common\AddOns\Contracts\ModuleInterface;
use FlowArenaModule\AddonCommon\Abstracts\AbstractModule;


class SwitchDecisionModule extends AbstractModule implements ModuleInterface
{
    /**
     * User-facing addon name displayed in UI and external interfaces.
     * @type string
     */
    protected string $title = "Switch Decision";

    /**
     * Unique internal addon alias, used system-wide; must not contain spaces.
     * @type string
     */
    protected string $alias = 'SwitchDecision';

    /**
     * Programming language in which the addon is implemented and executed.
     * @type string
     */
    protected string $language = "php";

    /**
     * Human-readable description explaining what the addon does and its purpose.
     * @type string
     */
    protected string $description = "The 'Switch Decision' addon routes incoming data to a specific branch based on a defined expression. Similar to a switch/case statement in programming, it evaluates the input and directs it only to the matching path. This enables structured branching within a workflow, allowing you to add and manage multiple processing paths with clear and controlled logic execution.";
    
    /**
     * Defines addon category/usage context (e.g. decision, trigger, database, termination).
     * @type string
     */
    protected string $blockType = "decision";

    /**
     * Fully qualified class responsible for processing addon logic.
     * @type string
     */
    protected string $handler = \FlowArenaModule\SwitchDecision\Handlers\SwitchDecisionHandler::class;

    /**
     * Path to the TypeScript file defining frontend integration logic.
     * @type string
     */
    protected string $frontServiceProvider = "../resources/js/index.ts";

    /**
     * Returns absolute path to the frontend TypeScript service provider file or null if not set.
     * @return string|null
     */
    public function getFrontServiceProvider():string|null 
    {
        return $this->relativePath(__DIR__, $this->frontServiceProvider);
    }
}
