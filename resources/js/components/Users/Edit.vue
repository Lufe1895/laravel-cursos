<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Editar Perfil</h1>
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
                                <label for="name">Nombre(s): </label>
                                <input type="text" v-model="user.name" class="form-control">
                                <span v-if="errors.name" class="font-italic text-danger">{{ errors.name[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="start_date">Apellidos: </label>
                                <input type="text" v-model="user.last_name" class="form-control">
                                <span v-if="errors.last_name" class="font-italic text-danger">{{ errors.last_name[0] }}</span>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="start_date">Foto de Perfil: </label>
                                <input type="file" accept="image/png, image/jpeg" ref="file" class="form-control">
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="start_date">Correo: </label>
                                <input type="email" v-model="user.email" class="form-control">
                                <span v-if="errors.email" class="font-italic text-danger">{{ errors.email[0] }}</span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-12 col-md-3">
                                <label for="description">Número de Teléfono: </label>
                                <input type="text" id="" v-model="user.phone_number" class="form-control">
                                <span v-if="errors.phone_number" class="font-italic text-danger">{{ errors.phone_number[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="description">Ciudad: </label>
                                <input type="text" id="" v-model="user.city" class="form-control">
                                <span v-if="errors.city" class="font-italic text-danger">{{ errors.city[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="description">Sexo: </label>
                                <select name="sex" id="" v-model="user.sex" class="form-control">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                <span v-if="errors.sex" class="font-italic text-danger">{{ errors.sex[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="description">Edad: </label>
                                <input type="number" v-model="user.age" id="" class="form-control">
                                <span v-if="errors.age" class="font-italic text-danger">{{ errors.age[0] }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-3">
                                <label for="status">Curso:</label>
                                <select v-model="user.course_id" id="" class="form-control">
                                    <option v-for="course in courses" v-bind:key="course.id" :value="course.id">{{ course.course_name }}</option>
                                </select>
                                <span v-if="errors.course_id" class="font-italic text-danger">{{ errors.course_id[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="status">Ocupación:</label>
                                <select v-model="user.ocupation_id" id="" class="form-control">
                                    <option v-for="ocupation in ocupations" v-bind:key="ocupation.id" :value="ocupation.id">{{ ocupation.ocupation_name }}</option>
                                </select>
                                <span v-if="errors.ocupation_id" class="font-italic text-danger">{{ errors.ocupation_id[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-3">
                                <label for="type">Nivel de Estudios:</label>
                                <select v-model="user.study_id" id="" class="form-control">
                                    <option v-for="study in studies" v-bind:key="study.id" :value="study.id">{{ study.study_level }}</option>
                                </select>
                                <span v-if="errors.study_id" class="font-italic text-danger">{{ errors.study_id[0] }}</span>
                            </div>

                            <div v-if="!alumno" class="form-group col-12 col-md-3">
                                <label for="tutor">Rol: </label>
                                <select v-model="user.role" id="" class="form-control">
                                    <option v-for="role in roles" v-bind:key="role.id" :value="role.id">{{ role.display_name }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- <input type="submit" value="Guardar" class="btn btn-primary"> -->
                        <div class="btn-group">
                            <a v-if="!alumno" href="/usuarios" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
                            <a v-if="alumno" :href="'/usuarios/' + id" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a mi Perfil</a>
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
    props:['apitoken', 'id', 'alumno', 'errors'],
    data:function(){
        return{
            ocupations:[],
            studies:[],
            courses:[],
            roles:[],
            user:{}
        }
    },
    mounted:function(){
        axios.post(BASE_URL + '/graphql', {
            query:`{
                user(id: ${this.id}){
                    name
                    last_name
                    phone_number
                    email
                    city
                    sex
                    age
                    ocupation{
                        id
                        ocupation_name
                    }
                    study{
                        id
                        study_level
                    }
                    role{
                        id
                        display_name
                    }
                    courses{
                        id
                        course_name
                    }
                }
                courses(page:1){
                    data{
                        id
                        course_name
                    }
                }
                ocupations(page:1){
                    data{
                        id
                        ocupation_name
                    }
                }
                studies(page:1){
                    data{
                        id
                        study_level
                    }
                }
                roles(page:1){
                    data{
                        id
                        description
                        display_name
                    }
                }
            }
            `
        }).then(response => {
            console.log(response);
            this.ocupations = response.data.data.ocupations.data;
            this.studies = response.data.data.studies.data;
            this.roles = response.data.data.roles.data;
            this.courses = response.data.data.courses.data;
            this.user = response.data.data.user;
            this.user.course_id = response.data.data.user.courses[0].id;
            this.user.role = response.data.data.user.role[0].id;
            this.user.study_id = response.data.data.user.study.id;
            this.user.ocupation_id = response.data.data.user.ocupation.id;
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        send:function() {
            const fd = new FormData();
            fd.append("name", this.user.name);
            fd.append("last_name", this.user.last_name);
            fd.append("email", this.user.email);
            fd.append("phone_number", this.user.phone_number);
            fd.append("city", this.user.city);
            fd.append("sex", this.user.sex);
            fd.append("age", this.user.age);
            fd.append("ocupation_id", this.user.ocupation_id);
            fd.append("study_id", this.user.study_id);
            fd.append("role", this.user.role);
            fd.append("course_id", this.user.course_id);
            fd.append("image", this.$refs.file.files[0]);
            axios
                .post(BASE_URL + '/api/usuarios/' + this.id + '?api_token=' + this.apitoken, fd, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(response => {
                    window.location.href = BASE_URL + '/usuarios/' + this.id;
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors;
                        console.log(this.errors);
                    }
                });
        }
    }
}
</script>