<script setup lang="ts">
/**
 * ----------------------------------------------------------
 * Imports
 * ----------------------------------------------------------
 */
import { ref, onMounted } from 'vue';

/**
 * ----------------------------------------------------------
 * Options
 * ----------------------------------------------------------
 */
defineOptions({
    name: 'OptionsForm'
});


/**
 * ----------------------------------------------------------
 * Props / Emits
 * ----------------------------------------------------------
 */
interface Props {
    addOnUses:any,
}
 
const props = defineProps<Props>();

/**
 * ----------------------------------------------------------
 * State (refs/reactive)
 * ----------------------------------------------------------
 */
interface FormInterface {
    expression:string,
    caseExpressions: {
        [key:string]: string
    }
}

const form = ref(<FormInterface>{
    expression:"",
    caseExpressions:{}
});


/**
 * ----------------------------------------------------------
 * Methods
 * ----------------------------------------------------------
 */
const onVueMounted = () => {
    props.addOnUses.getOptions(form.value);
    props.addOnUses.mergeOptionsWithPointBlockByKey(
                form.value.caseExpressions, 
                '',
                function (key) { console.log(key, '-  invalidKey') } // check this (rm Key)
            );    
}

const addCaseExpression = () => {
    let key = `case-${Date.now()}`;
    form.value.caseExpressions[key] = '';
    props.addOnUses.createExpansionPoint( key, '' );
}
const deleteCaseExpression = (keyName: string) => {
    delete form.value.caseExpressions[keyName];
    props.addOnUses.deleteExpansionPoint( keyName );
}

const isCaseExpressionsDisabled = (keyName: string) => {
     return !props.addOnUses.isExpansionPointDeletable(keyName);
}

const changeExpression = () => {
    changeField(['expression'], form.value.expression)

    for (let key in form.value.caseExpressions) {
        updateLabel(key);
    }
}
const changeCaseExpressionsField = (keyName: string) => {
    updateLabel(keyName);
    changeField(['caseExpressions', keyName], form.value.caseExpressions[keyName])
}

const updateLabel = (keyName: string) => {
    props.addOnUses.updateExpansionPoint( keyName, `switch( ${form.value.expression} ) === '${form.value.caseExpressions[keyName]}'` );
}

const changeField = ( fields: string[], value :string ) => {
    props.addOnUses.updateOption( fields, value );
}

/**
 * ----------------------------------------------------------
 * Lifecycle
 * ----------------------------------------------------------
 */
onMounted(onVueMounted)


</script>

<template>
    <b-col>
        <b-row>
            <b-col md="10"  class="mb-2">
                <BFormInput 
                    v-model="form.expression" 
                    @change="changeExpression(form.expression)"
                    placeholder="Enter expression" 
                />
            </b-col>
            <b-col md="2" class="d-grid gap-2">
                <BButton 
                    @click="addCaseExpression()"
                    variant="success"
                > 
                    <fa icon="circle-plus" /> 
                </BButton>
            </b-col>
        </b-row>
        <b-row v-for="(swCase, caseName) in form.caseExpressions" class="mt-2">
            <b-col md="10">
                <BFormInput 
                    v-model="form.caseExpressions[caseName]" 
                    @change="changeCaseExpressionsField(caseName)"
                    placeholder="Enter Case expression" 
                />
            </b-col>
            <b-col md="1" class="d-grid gap-2">
                <BButton 
                    @click="deleteCaseExpression(caseName)"
                    :disabled="isCaseExpressionsDisabled(caseName)"
                    variant="outline-warning"
                >
                    <fa icon="circle-minus" /> 
                </BButton>
            </b-col>
        </b-row>
    </b-col>
</template>
<style lang="scss">
</style>

