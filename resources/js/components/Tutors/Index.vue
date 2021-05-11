<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Tutores</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo tutor</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="bg-dark" scope="col">Nombre</th>
                            <th class="bg-dark" scope="col">Perfil Académico</th>
                            <th class="bg-dark" scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="tutor in tutors" v-bind:key="tutor.id">
                            <td>{{ tutor.name }}</td>
                            <td>{{ tutor.academic_profile }}</td>
                            <td>
                                <a :href="getEditRoute(tutor.id)"><i class="fas fa-edit text-success"></i></a>
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
    data:function(){
        return{
            url: BASE_URL + '/tutores/create',
            tutors:[]
        }
    },
    mounted:function(){
        axios
            .post(BASE_URL + '/graphql', {
                query:`{
                    tutors(page: 1){
                        data{
                            id
                            name
                            academic_profile
                        }
                    }
                }`
            }).then(response => {
                console.log(response);
                this.tutors = response.data.data.tutors.data;
            }).catch(error => {
                console.log(error);
            })
            
    },
    methods:{
        getEditRoute: (id) => {
            return BASE_URL + '/tutores/' + id + '/edit';
        }
    }
}
</script>

<style>

</style>