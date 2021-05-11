<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Usuarios</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo Usuario</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="bg-dark" scope="col">Nombre(s)</th>
                            <th class="bg-dark" scope="col">Apellidos</th>
                            <th class="bg-dark d-none d-sm-table-cell" scope="col">Correo</th>
                            <th class="bg-dark d-none d-sm-table-cell" scope="col">Rol</th>
                            <th class="bg-dark" scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="user in users" v-bind:key="user.id">
                            <td>{{ user.name }}</td>
                            <td>{{ user.last_name }}</td>
                            <td class="d-none d-sm-table-cell">{{ user.email }}</td>
                            <td class="d-none d-sm-table-cell">{{ user.role[0].display_name }}</td>
                            <td>
                                <a :href="getShowRoute(user.id)"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a :href="getEditRoute(user.id)"><i class="fas fa-edit text-success"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a :href="getAccountRoute(user.id)"><i class="fas fa-user text-danger"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['apitoken'],
    data:function() {
        return{
            url: BASE_URL + '/usuarios/create',
            users:[]
        }
    },
    mounted:function () {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                users(page: 1) {
                    data{
                        id
                        name
                        last_name
                        email
                        role{
                            display_name
                        }
                    }
                }
            }`
        }).then(response => {
            console.log(response);
            this.users = response.data.data.users.data;
            console.log(this.users[0].role.display_name);
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        getEditRoute : (id) => {
            return BASE_URL + '/usuarios/' + id + '/edit';
        },
        getShowRoute : (id) => {
            return BASE_URL + '/usuarios/' + id;
        },
        getAccountRoute : (id) => {
            return BASE_URL + '/usuarios/' + id + '/account';
        }
    }
}
</script>

<style>

</style>