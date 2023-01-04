<template>
    <form @submit.prevent="addUpdate" class="emp-form">
            <input placeholder="name" type="text" name="name" v-model="state.List.name"><br>
            <input placeholder="email" type="text" name="email" v-model="state.List.email"> <br>
            <input placeholder="address" type="text" name="address" v-model="state.List.address"> <br>
            <input placeholder="phone" type="text" name="phone" v-model="state.List.phone"> <br>
            <slot></slot>
    </form>
</template>

<script setup>
import { reactive } from 'vue';

const props = defineProps({
    updateData: Object
})
const emit = defineEmits([
    'add'
]);
const state = reactive({
    List: {
        name: '',
        email: '',
        address: '',
        phone: ''
    }
})
console.log(props.updateData)
state.List = props.updateData;
function addUpdate() {
    console.log('fire emit')
    emit('add', state.List);
    state.List.id = '';       
}

</script>

<style scoped>
.emp-form {
    border-radius: 17px;
    background: #ecf0f3;
    max-width: 262px;
    padding: 15px;
    padding-top: 24px;
    padding-bottom: 55px;
    box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
    margin: auto;
    margin-bottom: 62px;
}

.emp-form input {
    /* padding: 0 10px;
    border-radius: 6px;
    font-size: 20px;*/
    margin-bottom: 11px;
    position: relative;
    width: 98%;
    background: #ecf0f3;
    padding: 3px;
    padding-left: 20px;
    height: 42px;
    font-size: 14px;
    border-radius: 50px;
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
    border: none;
}

</style>