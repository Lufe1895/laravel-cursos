<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Alta de Tutores</h1>
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
                            <div class="form-group col-12 col-md-7">
                                <label for="">Nombre del tutor: </label>
                                <input type="text" v-model="tutor.name" class="form-control">
                                <span v-if="errors.name" class="font-italic text-danger">{{ errors.name[0] }}</span>
                            </div>

                            <div class="form-group col-12 col-md-5">
                                <label for="">Perfil académico: </label>
                                <input type="text" v-model="tutor.academic_profile" class="form-control">
                                <span v-if="errors.academic_profile" class="font-italic text-danger">{{ errors.academic_profile[0] }}</span>
                            </div>
                        </div>

                        <div class="btn-group">
                            <a href="/tutores" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
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
    data:function() {
        return {
            tutor:{},
            errors:[]
        }
    },
    methods:{
        send:function() {
            axios
                .post(BASE_URL + '/api/tutores?api_token=' + this.apitoken, this.tutor)
                .then(response => {
                    window.location.href = BASE_URL + '/tutores';
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 422) {
                        this.errors =error.response.data.errors;
                        console.log(this.errors);
                    }
                })
        }
    }
}
</script>

<style>

</style>