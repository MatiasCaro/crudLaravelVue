<template>
    <div>

        <div class="container">
            <form class="form-group" @submit.prevent="editarUser(usuario)" v-if="editarActivo">
                <h3>Editar usuarios</h3>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" v-model="usuario.name" placeholder="Nombre" class="from-control mb-2" required>
                    </div>

                    <div class="col-md-6">
                        <input type="email" v-model="usuario.email" placeholder="Email" class="from-control mb-2" required>
                    </div>
                </div>
                <button class="btn btn-warning" type="submit">Editar</button>
                <button @click="cancelarEditado" class="btn btn-danger" type="submit">Cancelar</button>

            </form>

            <form class="form-group" @submit.prevent="agregarUser" v-else>
                <h3>Agregar usuarios</h3>

                <div class="row">
                    <div class="col-md-6">
                        <input type="text" v-model="usuario.name" placeholder="Nombre" class="from-control mb-2" required>
                        <input type="email" v-model="usuario.email" placeholder="Email" class="from-control mb-2" required>

                    </div>

                    <div class="col-md-6">
                        <input type="password" v-model="usuario.password" placeholder="Contraseña" class="from-control mb-2" required>
                        <input type="password" v-model="usuario.password_confirm" placeholder="Confirmar Contraseña" class="from-control mb-2" required>


                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Agregar</button>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <button @click="getUsers()" class="btn btn-success" type="submit">Ver listado de usuarios</button>
                </div>
            </div>
            <v-client-table :data="tableData" :columns="columns" :options="options">
                <template slot="eliminar" slot-scope="props">
                    <div>
                        <button class="btn btn-danger mb-2" @click="eliminar(props.row.id)">Eliminar</button>
                    </div>
                </template>
                <template slot="editar" slot-scope="props">
                    <div>
                        <button class="btn btn-warning mb-2" @click="editar(props.row)">Editar</button>
                    </div>
                </template>
            </v-client-table>
        </div>

        <div class="container">
            <form class="form-group" @submit.prevent="editUserFile()" enctype="multipart/form-data" v-if="editarFile">
                <h3>Editar propietario de archivo</h3>
                <div class="row">
                    <div class="col-md-6">
                        <v-select :options="optionsvalue" label="title" v-model="userSelect"></v-select>
                    </div>
                </div>
                <button class="btn btn-warning" type="submit">Editar</button>
                <button @click="cancelarEditadoFile" class="btn btn-danger" type="submit">Cancelar</button>

            </form>

            <form class="form-group" @submit.prevent="uplodadFile()" enctype="multipart/form-data" v-else>
                <h3>Agregar Archivos</h3>
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" class="form-control mb-2" v-on:change="onFileChange">
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Agregar</button>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <button @click="getFiles()" class="btn btn-success" type="submit">Ver listado de archivos</button>
                </div>
            </div>
            <v-client-table :data="tableData2" :columns="columns2" :options="options2">
                <template slot="eliminar" slot-scope="props">
                    <div>
                        <button class="btn btn-danger mb-2" @click="eliminarFile(props.row.id)">Eliminar</button>
                    </div>
                </template>
                <template slot="editar" slot-scope="props">
                    <div>
                        <button class="btn btn-warning mb-2" @click="editFile(props.row)">Editar</button>
                    </div>
                </template>
            </v-client-table>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                columns: [],
                columns2: [],
                tableData: [],
                tableData2: [],
                options: {},
                options2: {},
                usuario: {
                    name: '', email: '', password: '', password_confirm: '',
                },
                editarActivo: false,
                file: '',
                optionsvalue: [],
                editarFile: false,
                userSelect: ''
            }
        },
        mounted(){
            this.vSelectUser();
        },
        methods:{
            agregarUser(){

                if(this.usuario.name.trim() === '' || this.usuario.email.trim() === '' ||
                   this.usuario.password.trim() === ''  || this.usuario.password_confirm.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar.');
                    return;
                }

                if(this.usuario.password != this.usuario.password_confirm){
                    alert('Las contraseñas no son iguales.');
                    return;
                }

                const data = {
                    name: this.usuario.name,
                    email: this.usuario.email,
                    password: this.usuario.password,
                }

                this.usuario.name = '';
                this.usuario.email = '';
                this.usuario.password = '';
                this.usuario.password_confirm = '';

                axios.post('/crud', data).then( res => {
                    this.getUsers();
                    alert('Usuario creado exitosamente!');
                }).catch((error) => {
                    console.log(error)
                });
            },

            eliminar(id){
                // console.log(id)
                axios.delete(`/crud/${id}`).then( res => {
                    this.getUsers();
                    alert('El usuario ha sido eliminado exitosamente')
                })
            },

            editar(usuario){
                this.editarActivo = true;
                this.usuario.name = usuario.name;
                this.usuario.email = usuario.email;
                this.usuario.id = usuario.id;
                // console.log(usuario);
            },

            getUsers(){
                axios.get('/crud').then( res => {
                    // console.log(res);
                    this.columns = ['id','name', 'email', 'eliminar', 'editar'];
                    this.tableData = res.data;
                    this.options = {
                        headings: {
                            name: 'Nombre',
                            email: 'Email',
                            eliminar: 'Eliminar',
                            editar: 'Editar'
                        },
                        perPage: 2,
                        pagination: {
                            edge: false,
                            dropdown: false,
                            chunk: 2
                        },
                        sortIcon: {
                            is: 'fa-sort',
                            base: 'fa',
                            up: 'fa-long-arrow-up',
                            down: ' fa-long-arrow-down'
                        }
                    }
                }).catch((error) => {
                    console.log(error)
                });
            },

            editarUser(usuario){
                const data = {
                    name: usuario.name,
                    email: usuario.email,
                }

                this.usuario.name = '';
                this.usuario.email = '';

                axios.put(`/crud/${usuario.id}`,data).then( res => {
                    this.getUsers();
                    this.editarActivo = false;
                    alert('Usuario editado exitosamente!');
                }).catch((error) => {
                    console.log(error)
                });
            },

            cancelarEditado(){
                this.editarActivo = false;

                this.usuario.name = '';
                this.usuario.email = '';
            },

            onFileChange(e){
                // console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },

            uplodadFile() {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.file);

                axios.post('/uplodad-file', formData, config)
                .then( res => {
                    this.getFiles();
                    alert('El archivo fue cargado exitosamente!');
                })
                .catch((error) => {
                     console.log(error)
                });
            },

            vSelectUser(){
                axios.get('/crud').then( res => {
                    this.optionsvalue = res.data.map(value => ({id: value.id, title: value.name}));
                }).catch((error) => {
                    console.log(error)
                });
            },

            getFiles(){
                axios.get('/get-files').then( res => {
                    // console.log(res);
                    this.columns2 = ['id','path_file', 'name', 'eliminar', 'editar'];
                    this.tableData2 = res.data;
                    this.options2 = {
                        headings: {
                            id: 'Identificador',
                            path_file: 'Nombre',
                            name: 'Dueño',
                            eliminar: 'Eliminar',
                            editar: 'Editar'
                        },
                        perPage: 2,
                        pagination: {
                            edge: false,
                            dropdown: false,
                            chunk: 2
                        },
                        sortIcon: {
                            is: 'fa-sort',
                            base: 'fa',
                            up: 'fa-long-arrow-up',
                            down: ' fa-long-arrow-down'
                        }
                    }
                }).catch((error) => {
                    console.log(error)
                });
            },

            eliminarFile(id){
                axios.get(`/delete-file/${id}`).then( res => {
                    this.getFiles();
                    console.log(res)
                    alert('El archivo ha sido eliminado exitosamente')
                })
            },

            editFile(file){
                this.editarFile = true;
                this.usuario.id = file.id;
            },

            editUserFile(){
                const data = {
                    id: this.usuario.id,
                    user_id: this.userSelect.id,
                }
                axios.post('/edit-user-file',data).then( res => {
                    this.getFiles();
                    this.editarFile = false;
                    alert('Dueño del archivo editado exitosamente!');
                }).catch((error) => {
                    console.log(error)
                });
            },

            cancelarEditadoFile(){
                this.editarFile = false;

            }
        }
    }
</script>
