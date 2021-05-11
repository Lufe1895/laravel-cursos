<template>
    <div class="content">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0 text-dark">Alta de Estados</h1>
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
                                <label for="name">Estado: </label>
                                <input type="text" v-model="role.name" class="form-control">
                            </div>

                            <div class="form-group col-12 col-md-6">
                                <label for="start_date">Descripción: </label>
                                <input type="text" v-model="role.display_name" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="start_date">Descripción: </label>
                                <input type="text" v-model="role.description" class="form-control">
                            </div>
                        </div>

                        <div class="row btn-group">
                            <a href="/roles" class="btn btn-secondary"><i class="fas fa-chevron-left"></i> &nbsp; Volver a la Lista</a>
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
        return {
            role:{}
        }
    },
    mounted:function() {
        axios.post(BASE_URL + '/graphql', {
            query:`{
                role(id: ${this.id}){
                    name
                    display_name
                    description
                }
            }`
        }).then(response => {
            console.log(response);
            this.role = response.data.data.role;
        }).catch(error => {
            console.log(error);
        })
    },
    methods:{
        send:function() {
            axios
                .post(BASE_URL + '/api/roles/' + this.id + '?api_token=' + this.apitoken, this.role)
                .then(response => {
                    window.location.href = BASE_URL + '/roles';
                    console.log(response);
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