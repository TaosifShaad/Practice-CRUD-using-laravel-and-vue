// import { ref, computed } from 'vue'
// import { defineStore } from 'pinia'

// export const useCounterStore = defineStore('counter', () => {
//   const count = ref(0)
//   const doubleCount = computed(() => count.value * 2)
//   function increment() {
//     count.value++
//   }

//   return { count, doubleCount, increment }
// })

import { defineStore } from 'pinia';
import axios from 'axios';

export let EmployeeListView = defineStore('EmployeeData', {
    state() {
        return {
            employeeArr: {},
        }
    },
    actions: {
        getEmployeeData() {
            axios.get('http://127.0.0.1/api/home').then(({data}) => {
                console.log('sldkfjalfl');
                this.employeeArr = data;
            });
        }
    }
})