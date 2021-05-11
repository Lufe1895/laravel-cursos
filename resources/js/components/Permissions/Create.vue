<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Alta de Permisos</h1>
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
                                <label for="name">Clave: </label>
                                <input type="text" v-model="permission.name" class="form-control">
                                <span v-if="errors.name" class="font-italic text-danger">{{ errors.name[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="start_date">Nombre: </label>
                                <input type="text" v-model="permission.display_name" class="form-control">
                                <span v-if="errors.display_name" class="font-italic text-danger">{{ errors.display_name[0] }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="start_date">Descripción: </label>
                                <input type="text" v-model="permission.description" class="form-control">
                                <span v-if="errors.description" class="font-italic text-danger">{{ errors.description[0] }}</span>
                            </div>
                        </div>

                        <div class="row btn-group">
                            <a href="/permisos" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
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
    props:['apitoken'],
    data:function(){
        return {
            permission:{},
            errors:[]
        }
    },
    methods:{
        send:function() {
            axios
                .post(BASE_URL + '/api/permisos?api_token=' + this.apitoken, this.permission)
                .then(response => {
                    window.location.href = BASE_URL + '/permisos';
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 422) {
                        this.errors =error.response.data.errors;
                        console.log(this.errors);
                    }
                });
        }
    }
}
</script>

<style>

</style>