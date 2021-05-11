<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Detalles de Curso</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img :src="course.image" class="card-img" alt="curso">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{ course.course_name }}</h5>
                                        <p class="card-text">
                                            {{ course.description }}
                                        </p>
                                        <p class="card-text text-muted">
                                            <span class="font-weight-bold">Fecha de Inicio: </span>
                                            {{ course.start_date }}
                                        </p>
                                        <p class="card-text text-muted">
                                            <span class="font-weight-bold">Fecha de Término: </span>
                                            {{ course.finish_date }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-bordered">
                        <tbody>

                            <tr>
                                <td class="font-weight-bold">Número de Horas:</td>
                                <td>{{ course.hours }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Estado del Curso:</td>
                                <td>{{ course.status.name }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Tutor del Curso:</td>
                                <td>{{ course.tutor.name }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Tipo de Curso:</td>
                                <td>{{ course.type.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-group">
                    <a v-if="!alumno" href="/cursos" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
                    <a v-if="alumno" :href="'/usuarios/cursos/' + userid" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a mis Cursos</a>
                    <a v-if="!alumno" :href="url" class="btn btn-danger"><i class="fas fa-edit"></i>&nbsp;Editar</a>
                    <a v-if="!subscribed" :href="subscribe(this.id)" class="btn btn-primary"><i class="fas fa-plus-circle"></i>&nbsp;Incribirme</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['id', 'alumno', 'userid', 'subscribed'],
    data:function() {
        return {
            url : BASE_URL + '/cursos/' + this.id + '/edit',
            course:[]
        }
    },
    mounted:function() {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                course(id: ${this.id}){
                    course_name
                    start_date
                    finish_date
                    hours
                    description
                    status{
                        name
                    }
                    type{
                        name
                    }
                    tutor{
                        name
                    }
                    image
                }
            }`
        }).then(response => {
            console.log(response);
            this.course = response.data.data.course;
        }).catch(error => {
            console.log(error);
        });
    },
    methods: {
        subscribe(id) {
            return BASE_URL + '/usuarios/inscribir/' + id;
        }
    }
}
</script>

<style>

</style>