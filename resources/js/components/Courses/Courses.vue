<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Cursos</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="col-12 col-md-10 offset-md-1">
                    <div class="row" v-for="course in courses" v-bind:key="course.id">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img :src="course.image" class="card-img" alt="course">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="h3">{{ course.course_name }}</h5>
                                        <p class="card-text">{{ course.description }}</p>
                                        <p class="card-text text-muted"><span class="font-weight-bold">Fecha de Inicio: </span>{{ course.start_date }}</p>
                                        <p class="card-text text-muted"><span class="font-weight-bold">Tutor: </span>{{ course.tutor.name }}</p>
                                        <a :href="getShowRoute(course.id)" class="btn btn-primary"><i class="fas fa-info"></i>&nbsp;&nbsp;Más Información</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                description
                                start_date
                                tutor{
                                    name
                                }
                                image
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
        getShowRoute : (id) => {
            return BASE_URL + '/cursos/' + id;
        }
    }
}
</script>

<style>

</style>