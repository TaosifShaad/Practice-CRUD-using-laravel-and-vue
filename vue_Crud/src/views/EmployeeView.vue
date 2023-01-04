<template>
    <div>
        <employeeList></employeeList>
        <!-- <form @submit.prevent="addUpdate" class="emp-form">
            <input placeholder="name" type="text" name="name" v-model="state.addList.name"> <br>
            <input placeholder="email" type="text" name="email" v-model="state.addList.email"> <br>
            <input placeholder="address" type="text" name="address" v-model="state.addList.address"> <br>
            <input placeholder="phone" type="text" name="phone" v-model="state.addList.phone"> <br>
            <button type="submit" class="add-btn">add</button>
        </form> -->
        
        <employeeAdd @add="addUpdate" :updateData="state.addList">
            <button type="submit" class="add-btn">add</button>
        </employeeAdd>
        <table style="text-align: center;" class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Operation</th>>
                </tr>
            </thead>
            <tbody>
                <tr class="table-light" v-for="(list, index) in state.lists.data" :key="list.id">
                    <th scope="row">{{ (state.page-1)*5 + ++index }}</th>
                    <td>{{ list.name }}</td>
                    <td>{{ list.email }}</td>
                    <td>{{ list.address }}</td>
                    <td>{{ list.phone }}</td>
                    <td>
                        <button class="btn btn-info" @click="updateclick(list)">update</button>
                        <button class="btn btn-danger" @click="deleteData(list.id)">delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <Bootstrap5Pagination class="page-num" align="center" :data="state.lists" @pagination-change-page="getList" ></Bootstrap5Pagination>

    </div>
</template>

<script setup>
import employeeList from '@/components/EmployeeList.vue';
import axios from 'axios';
import { reactive } from 'vue';
import Swal from 'sweetalert2';
import { createToaster } from "@meforma/vue-toaster";
import employeeAdd from "@/components/EmployeeAdd.vue";
import { Bootstrap5Pagination } from 'laravel-vue-pagination';

const toaster = createToaster({
    position: 'top-right'
});

const state = reactive({
    lists: {
        name: '',
        email: '',
        address: '',
        phone: ''
    },
    addList: {
        name: '',
        email: '',
        address: '',
        phone: ''
    },
    page: ''
})

async function getList(page = 1) {
    state.page = page;
    const url = 'http://127.0.0.1/api/home?page=' + page;
    const { data } = await axios.get(url);
    state.lists = data;
}

function addUpdate(e) {
    console.log(e.id);
    state.addList = e;
    if (!state.addList.id) {
        addEmployee();
    } else {
        updateEmployee(state.addList.id);
    }
}

async function updateEmployee(id) {
    const url = 'http://127.0.0.1/api/update/' + id;
    const { data } = await axios.put(url, state.addList);
    if (data.success) {
            toaster.show("Updated Employee", {
                type: "success",
            });
            getList(state.page);
            state.addList.name = '';
            state.addList.email = '';
            state.addList.address = '';
            state.addList.phone = '';
    }
}

async function addEmployee() {
    const url = 'http://127.0.0.1/api/create';
    const {data} = await axios.post(url, state.addList);
    if (data.success) {
        toaster.show("Added Employee", {
            type: "success",
        });
        getList(state.page);
        state.addList.name = '';
        state.addList.email = '';
        state.addList.address = '';
        state.addList.phone = '';
    }
}

function deleteData(id) {
    Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Delete',
        denyButtonText: `Cancel`,
        icon: 'warning'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = 'http://127.0.0.1/api/delete/' + id;
            axios.delete(url).then(({ data }) => {
                console.log('deleted');
                getList(state.page);
            })
            Swal.fire('Deleted!', '', 'error')
        }
    })
}

// function updateData(id) {
//     const url = 'http://127.0.0.1/api/update/' + id;
// }

function updateclick(list) {
    // console.log(list)
    state.addList.name = list.name;
    state.addList.email = list.email;
    state.addList.address = list.address;
    state.addList.phone = list.phone;
    state.addList.id = list.id;
}

getList();
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
}

.add-btn {
    position: absolute;
    right: 19px;
    padding: 8px 12px;
    background: cornflowerblue;
    color: white;
    border-radius: 9px;
    border: none;
    font-size: 15px;
    box-shadow: 4px 4px 6px #cbced1, -6px -6px 6px white;
    transition: box-shadow 0.7s;
}

.add-btn:hover {
    box-shadow: none;
}

.btn-info {
    margin-right: 5px;
}
</style>