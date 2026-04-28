
import { AbstractServiceProvider } from 'virtual:AddOnAbstract';
import { defineAsyncComponent, Component } from 'vue';
import SwitchDecision from './components/SwitchDecision.ts';

export default class FrontServiceProvider extends AbstractServiceProvider
{

    getIco():string
    {
        return new URL('./assets/switch-decision-logo.png', import.meta.url).href
    }

    getCollage():string
    {
        return new URL('./assets/switch-decision-collage.png', import.meta.url).href
    }

    getWorkflowBlocks():string[]
    {
        return [
            SwitchDecision,
        ]
    }

    getOptionsForm(): Component
    {
        return defineAsyncComponent(() =>
            import('./views/OptionsForm.vue')
        )
    }

}