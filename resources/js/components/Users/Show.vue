<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Detalles de Usuario</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img v-if="user.image" :src="user.image" class="card-img" alt="user">
                                    <img v-else src="/DefaultImage/Default.png" class="card-img" alt="user">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{ user.name }}</h5>
                                        <p class="card-text">
                                            {{ user.last_name }}
                                        </p>
                                        <p class="card-text text-muted">
                                            <span class="font-weight-bold">Correo: </span>
                                            {{ user.email }}
                                        </p>
                                        <p class="card-text text-muted">
                                            <span class="font-weight-bold">Teléfono: </span>
                                            {{ user.phone_number }}
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
                                <td class="font-weight-bold">Ciudad:</td>
                                <td class="">{{ user.city }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Sexo:</td>
                                <td>{{ user.sex }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Edad:</td>
                                <td>{{ user.age }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Curso:</td>
                                <td><a :href="verCursos(user.id)">Ver Cursos</a></td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Ocupación:</td>
                                <td>{{ user.ocupation.ocupation_name }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Estudios:</td>
                                <td>{{ user.study.study_level }}</td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Rol:</td>
                                <td>{{ user.role[0].display_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-group">
                    <a v-if="!alumno" href="/usuarios" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; <span class="d-none d-sm-inline">Volver a la Lista</span></a>
                    <a :href="url" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;<span class="d-none d-sm-inline">Editar Información</span></a>
                    <a :href="account" class="btn btn-danger"><i class="fas fa-user"></i>&nbsp;<span class="d-none d-sm-inline">Editar Contraseña</span></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:['id', 'alumno'],
    data:function() {
        return {
            url : BASE_URL + '/usuarios/' + this.id + '/edit',
            account : BASE_URL + '/usuarios/' + this.id + '/account',
            user:[]
        }
    },
    mounted:function() {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                user(id: ${this.id}) {
                    id
                    name
                    last_name
                    email
                    phone_number
                    city
                    sex
                    age
                    courses{
                        course_name
                    }
                    ocupation{
                        ocupation_name
                    }
                    study{
                        study_level
                    }
                    role{
                        display_name
                    }
                    image
                }
            }`
        }).then(response => {
            console.log(response);
            this.user = response.data.data.user;
        }).catch(error => {
            console.log(error);
        })
    },
    methods: {
        verCursos(id) {
            return BASE_URL + '/usuarios/cursos/' + id;
        }
    }
}
</script>

<style>

</style>