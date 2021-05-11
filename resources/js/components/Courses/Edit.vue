<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Alta de Cursos</h1>
            </div>
        </div>

        <div class="card">
            <div class="container-fluid">
                <div class="card-header border-0">
                    <h3 class="card-title">Rellena los campos y da click en Guardar</h3>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="course_name">Nombre del curso: </label>
                                <input type="text" v-model="course.course_name" class="form-control">
                                <span v-if="errors.course_name" class="font-italic text-danger">{{ errors.course_name[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="start_date">Fecha de Inicio: </label>
                                <input type="date" v-model="course.start_date" class="form-control">
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="finish_date">Fecha de Término: </label>
                                <input type="date" v-model="course.finish_date" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-12 col-md-2">
                                <label for="hours">Número de Horas: </label>
                                <input type="number" v-model="course.hours" id="hours" class="form-control">
                                <span v-if="errors.hours" class="font-italic text-danger">{{ errors.hours[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-10">
                                <label for="description">Descripción:</label>
                                <input type="text" v-model="course.description" id="" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-3">
                                <label for="status">Estado:</label>
                                <select v-model="course.status_id" id="" class="form-control">
                                    <option v-for="status in statuses" v-bind:key="status.id" :value="status.id">{{ status.name }}</option>
                                </select>
                                <span v-if="errors.status_id" class="font-italic text-danger">{{ errors.status_id[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="type">Tipo de Actividad:</label>
                                <select v-model="course.type_id" id="" class="form-control">
                                    <option v-for="type in types" v-bind:key="type.id" :value="type.id">{{ type.name }}</option>
                                </select>
                                <span v-if="errors.type_id" class="font-italic text-danger">{{ errors.type_id[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="tutor">Tutor: </label>
                                <select v-model="course.tutor_id" id="" class="form-control">
                                    <option v-for="tutor in tutors" v-bind:key="tutor.id" :value="tutor.id">{{ tutor.name }}</option>
                                </select>
                                <span v-if="errors.tutor_id" class="font-italic text-danger">{{ errors.tutor_id[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="hours">Imagen: </label>
                                <input type="file" accept="image/png, image/jpeg" ref="file" class="form-control">
                                <span v-if="errors.image" class="font-italic text-danger">{{ errors.image[0] }}</span>
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="/cursos" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
                            <button @click="send" type="button" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['apitoken', 'id'],
    data:function(){
        return{
            types:[],
            statuses:[],
            tutors:[],
            course:{},
            errors:[]
        }
    },
    mounted:function(){
        axios.post(BASE_URL + '/graphql', {
            query:`{
                statuses(page: 1) {
                    data {
                        id
                        name
                        description
                    }
                }
                types(page: 1) {
                    data {
                        id
                        name
                        description
                    }
                }
                tutors(page: 1) {
                    data {
                        id
                        name
                        academic_profile
                    }
                }
                course(id: ${this.id}){
                    course_name
                    start_date
                    finish_date
                    hours
                    description
                    status{
                        id
                        name
                    }
                    type{
                        id
                        name
                    }
                    tutor{
                        id
                        name
                    }
                }
            }
            `
        }).then(response => {
            console.log(response);
            this.statuses = response.data.data.statuses.data;
            this.types = response.data.data.types.data;
            this.tutors = response.data.data.tutors.data;
            this.course = response.data.data.course;
            this.course.status_id = this.course.status.id;
            this.course.tutor_id = this.course.tutor.id;
            this.course.type_id = this.course.type.id;
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        send:function() {
            const fd = new FormData();
            fd.append("course_name", this.course.course_name);
            fd.append("start_date", this.course.start_date);
            fd.append("finish_date", this.course.finish_date);
            fd.append("hours", this.course.hours);
            fd.append("description", this.course.description);
            fd.append("status_id", this.course.status_id);
            fd.append("type_id", this.course.type_id);
            fd.append("tutor_id", this.course.tutor_id);
            fd.append("image", this.$refs.file.files[0]);
            axios
                .post(BASE_URL + '/api/cursos/' + this.id + '?api_token=' + this.apitoken, fd, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(response => {
                    window.location.href = BASE_URL + '/cursos';
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                    console.log(this.course);
                    if(error.response.status == 422) {
                        this.errors =error.response.data.errors;
                        console.log(this.errors);
                    }
                });
        }
    }
}
</script>