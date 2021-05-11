<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Cursos</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="text-right"><a :href="url" class="button special"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Agregar un nuevo curso</a></p>

                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="bg-dark" scope="col">Nombre del curso</th>
                            <th class="bg-dark" scope="col">Fecha de Inicio</th>
                            <th class="bg-dark" scope="col">Status</th>
                            <th class="bg-dark d-none d-sm-table-cell" scope="col">Tipo de actividad</th>
                            <th class="bg-dark" scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="course in courses" v-bind:key="course.id">
                            <td>{{ course.course_name }}</td>
                            <td>{{ course.start_date }}</td>
                            <td>{{ course.status.name }}</td>
                            <td class="d-none d-sm-table-cell">{{ course.type.name }}</td>
                            <td>
                                <a :href="getShowRoute(course.id)"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a :href="getEditRoute(course.id)"><i class="fas fa-edit text-success"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a v-if="admin" @click="deleteCurso(course.id)" href="/cursos"><i class="fas fa-trash-alt text-danger"></i></a>
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
    props:['apitoken', 'admin'],
    data:function(){
        return {
            url: BASE_URL + '/cursos/create',
            courses:[]
        };
    },
    mounted:function(){
        axios
            .post(BASE_URL + '/graphql',{
                query:`
                    {
                        courses(page: 1){
                            data{
                                id
                                course_name
                                start_date
                                status{
                                    name
                                }
                                type{
                                    name
                                }
                            }
                        }
                    }
                `
            })
            .then(response => {
                console.log(response);
                this.courses = response.data.data.courses.data;
            })
            .catch(error => {
                console.log(error);
            })
    },
    methods:{
        getEditRoute : (id) => {
            return BASE_URL + '/cursos/' + id + '/edit';
        },
        getShowRoute : (id) => {
            return BASE_URL + '/cursos/' + id;
        },
        deleteCurso : (id) => {
            axios
                .post(BASE_URL + '/cursos/' + id, {_method: 'DELETE'})
                .then(response => {
                    console.log(response);
                    location.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>

<style>

</style>