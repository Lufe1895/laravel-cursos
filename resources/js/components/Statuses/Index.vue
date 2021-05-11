<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Estados</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo estado</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th class="bg-dark" scope="col">Estado</th>
                        <th class="bg-dark" scope="col">Descripción</th>
                        <th class="bg-dark" scope="col"></th>
                    </thead>

                    <tbody>
                        <tr v-for="status in statuses" v-bind:key="status.id">
                            <td>{{ status.name }}</td>
                            <td>{{ status.description }}</td>
                            <td>
                                <a :href="getEditRoute(status.id)"><i class="fas fa-edit text-success"></i></a>
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
            url: BASE_URL + '/estados/create',
            statuses:[]
        }
    },
    mounted:function(){
        axios
            .post(BASE_URL + '/graphql', {
                query:`
                    {
                        statuses(page: 1){
                            data{
                            id
                            name
                            description
                            }
                        }
                    }
                `
            }).then(response => {
                console.log(response);
                this.statuses = response.data.data.statuses.data;
            }).catch(error => {
                console.log(error);
            })
    },
    methods:{
        getEditRoute: (id) => {
            return BASE_URL + '/estados/' + id + '/edit';
        }
    }
}
</script>

<style>

</style>