<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Tipos</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo tipo</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="bg-dark" scope="col">Nombre</th>
                            <th  class="bg-dark d-none d-sm-table-cell" scope="col">Descripción</th>
                            <th class="bg-dark" scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="type in types" v-bind:key="type.id">
                            <td>{{ type.name }}</td>
                            <td class="d-none d-sm-table-cell">{{ type.description }}</td>
                            <td>
                                <a :href="getEditRoute(type.id)"><i class="fas fa-edit text-success"></i></a>
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
            url: BASE_URL + '/tipos/create',
            types:[]
        }
    },
    mounted:function () {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                types(page: 1){
                    data{
                    id
                    name
                    description
                    }
                }
            }`
        }).then(response => {
            console.log(response);
            this.types = response.data.data.types.data;
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        getEditRoute: (id) => {
            return BASE_URL + '/tipos/' + id + '/edit';
        }
    }
}
</script>

<style>

</style>