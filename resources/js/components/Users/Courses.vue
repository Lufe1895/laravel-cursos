<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Mis Cursos</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div v-for="course in courses" v-bind:key="course.id" class="col-12 col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img :src="course.image" class="card-img" alt="Imagen">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{ course.course_name }}</h5>
                                        <p class="card-text">{{ course.description }}</p>
                                        <p class="card-text text-muted"><span class="font-weight-bold">Fecha de Término: </span>{{ course.finish_date }}</p>
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
    props:['apitoken', 'id'],
    data:function() {
        return{
            courses:[]
        }
    },
    mounted:function () {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                user(id: ${this.id}) {
                    courses{
                        id
                        course_name
                        description
                        finish_date
                        image
                    }
                }
            }
            `
        }).then(response => {
            console.log(response);
            this.courses = response.data.data.user.courses;
            console.log(this.users[0].role.display_name);
        }).catch(error => {
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