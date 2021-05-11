<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Roles</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo rol</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th class="bg-dark" scope="col">Clave</th>
                        <th class="bg-dark" scope="col">Nombre</th>
                        <th class="bg-dark d-none d-sm-table-cell" scope="col">Descripción</th>
                        <th class="bg-dark" scope="col"></th>
                    </thead>

                    <tbody>
                        <tr v-for="role in roles" v-bind:key="role.id">
                            <td>{{ role.name }}</td>
                            <td>{{ role.display_name }}</td>
                            <td class="d-none d-sm-table-cell">{{ role.description }}</td>
                            <td>
                                <a :href="getEditRoute(role.id)"><i class="fas fa-edit text-success"></i></a>
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
        return {
            url: BASE_URL + '/roles/create',
            roles:[]
        }
    },
    mounted:function(){
        axios
            .post(BASE_URL + '/graphql', {
                query:`
                    {
                        roles(page:1){
                            data{
                                id
                                name
                                display_name
                                description
                            }
                        }
                    }
                `
            }).then(response => {
                console.log(response);
                this.roles = response.data.data.roles.data;
            }).catch(error => {
                console.log(error);
            })
    },
    methods:{
        getEditRoute: (id) => {
            return BASE_URL + '/roles/' + id + '/edit';
        }
    }
}
</script>

<style>

</style>