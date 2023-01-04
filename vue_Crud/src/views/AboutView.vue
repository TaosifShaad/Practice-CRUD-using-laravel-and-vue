<template>
  <div id="about">
    <h4>{{ state.item }}</h4>
    <ul v-for="i in state.item" :key="i.id">
      <li>{{ i.name }}</li>
      <li>{{ i.email }}</li>
      <li>{{ i.address }}</li>
      <li>{{ i.phone }}</li>
    </ul>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { EmployeeListView } from '../stores/counter';

const state = reactive({
  item: {}
})
const emp = EmployeeListView();
emp.getEmployeeData();
state.item = emp.employeeArr;
console.log('item' + state.item);
</script>

<style scoped>
  #about {
    max-width: 500px;
    margin: auto;
  }
</style>