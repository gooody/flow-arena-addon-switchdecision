

import {AbstractFlowElements} from 'virtual:AddOnAbstract';
import {WorkflowConstants, WorkflowTypes} from 'virtual:AddOnMiscellaneous';
import img from "../assets/switch-decision-logo.png";


export default class SwitchDecision extends AbstractFlowElements implements WorkflowTypes.FlowArenaMicroservicesInterface 
{
    
    static readonly nodeShape = 'SwitchDecision';

    readonly defaultNumberOfExpansionPoint:number = 3;
    readonly maximumNumberOfExpansionPoint:number = -1;
    readonly minimumNumberOfExpansionPoint:number = 1;

    
//    protected idPrefix(): string {
//        return WorkflowConstants.WORKFLOW_ADDON_ID_PREFIX;
//    }  

    protected getLabel():string {
        return 'sWitch (x)';
    }

    protected getNodeDefinition()
    {
        return {
            width: 140,
            height: 80,
            markup: [

                { tagName: 'polygon',  selector: 'body', },
                { tagName: 'circle', selector: 'iconBg', },
                { tagName: 'image', selector: 'icon', },
                { tagName: 'text', selector: 'label', },
            ],
            attrs: {
                body: {
                    refPoints: '70,0 140,40 70,80 0,40',
                    fill: '#69c0ff',
                    stroke: '#00000050',
                    strokeWidth: 2,
                },
                label: {
                    text: this.getLabel(),
                    fontSize: 14,
                    fill: '#000',
                    refX: 70,
                    refY: 40,
                    textAnchor: 'middle',
                    textVerticalAnchor: 'middle',
                },
                iconBg: {
                    cx: 30,
                    cy: 10,
                    r: 18,
                    fill: '#f0f0f0',
                    stroke: '#979797',
                    strokeWidth: 2,
                    pointerEvents: 'none',
                },
                icon: {
                    'xlink:href': img,
                    width: 50,
                    height: 50,
                    x: 4,
                    y: -16,
                    pointerEvents: 'none',
                },
            }
        }

    }
}
