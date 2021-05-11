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
                            <div class="form-group col-12">
                                <label for="course_name">Antigüa Contraseña: </label>
                                <input type="password" v-model="user.old_password" class="form-control">
                                <span v-if="errors.old_password" class="font-italic text-danger">{{ errors.old_password[0] }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for="description">Nueva Contraseña: </label>
                                <input type="password" id="" v-model="user.password" class="form-control"> 
                                <span v-if="errors.password" class="font-italic text-danger">{{ errors.password[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="description">Confirmar Nueva Contraseña: </label>
                                <input type="password" id="" v-model="user.password_confirmation" class="form-control">
                            </div>
                        </div>

                        <!-- <input type="submit" value="Guardar" class="btn btn-primary"> -->
                        <div class="btn-group">
                            <a href="/usuarios" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
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
    props:['apitoken', 'id', 'errors'],
    data:function(){
        return{
            user:{}
        }
    },
    mounted:function(){
        axios.post(BASE_URL + '/graphql', {
            query:`{
                user(id: ${this.id}){
                    email
                }
            }
            `
        }).then(response => {
            console.log(response);
            this.user = response.data.data.user;
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        send:function() {
            axios
            .post(BASE_URL + '/api/usuarios/' + this.id + '/account?api_token=' + this.apitoken, this.user)
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