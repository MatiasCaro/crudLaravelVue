<template>
    <div>
        <form class="form-group" @submit.prevent="editarUser(usuario)" v-if="editarActivo">
            <h3>Editar usuarios</h3>

            <div class="row">
                <div class="col-md-6">
                    <input type="text" v-model="usuario.rut" v-rut:live placeholder="Rut ej: XXXXXXXX-X" class="from-control mb-2" readonly>
                    <input type="text" v-model="usuario.nombre" placeholder="Nombre" class="from-control mb-2" readonly>
                    <input type="text" v-model="usuario.direccion" placeholder="Dirección" class="from-control mb-2" required>
                    <input type="text" v-model="usuario.comuna" placeholder="Comuna" class="from-control mb-2" required>
                </div>

                <div class="col-md-6">
                    <select v-model="usuario.genero" class="from-control mb-2" readonly>
                        <option value="" selected>Selecciona tu genero</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                    <input type="email" v-model="usuario.email" placeholder="Email" class="from-control mb-2" required>
                    <input type="number" v-model="usuario.fono" min="1" placeholder="Celular" class="from-control mb-2" required>
                    <select v-model="usuario.region" class="from-control mb-2" required>
                        <option value="" selected>Seleccione una región</option>
                        <option value="Arica y Parinacota">Arica y Parinacota</option>
                        <option value="Tarapacá">Tarapacá</option>
                        <option value="Antofagasta">Antofagasta</option>
                        <option value="Atacama">Atacama</option>
                        <option value="Coquimbo">Coquimbo</option>
                        <option value="Valparaíso">Valparaíso</option>
                        <option value="Región del Libertador Gral. Bernardo O’Higgins">Región del Libertador Gral. Bernardo O’Higgins</option>
                        <option value="Región del Maule">Región del Maule</option>
                        <option value="Región del Biobío">Región del Biobío</option>
                        <option value="Región de la Araucanía">Región de la Araucanía</option>
                        <option value="Región de Los Ríos">Región de Los Ríos</option>
                        <option value="Región de Los Lagos">Región de Los Lagos</option>
                        <option value="Región Aisén del Gral. Carlos Ibáñez del Campo">Región Aisén del Gral. Carlos Ibáñez del Campo</option>
                        <option value="Región de Magallanes y de la AntárVca Chilena">Región de Magallanes y de la AntárVca Chilena</option>
                        <option value="Región Metropolitana de Santiago">Región Metropolitana de Santiago</option>
                    </select>
                    <input type="date" v-model="usuario.f_naci" placeholder="Fecha Nacimiento" class="from-control mb-2" readonly>

                </div>
            </div>
            <button class="btn btn-warning" type="submit">Editar</button>
            <button @click="cancelarEditado" class="btn btn-danger" type="submit">Cancelar</button>

        </form>

        <form class="form-group" @submit.prevent="agregarUser" v-else>
            <h3>Agregar usuarios</h3>

            <div class="row">
                <div class="col-md-6">
                    <input v-model="usuario.rut" v-rut:live placeholder="Rut ej: XXXXXXXX-X" class="from-control mb-2" required>
                    <input type="text" v-model="usuario.nombre" placeholder="Nombre" class="from-control mb-2" required>
                    <input type="text" v-model="usuario.direccion" placeholder="Dirección" class="from-control mb-2" required>
                    <input type="text" v-model="usuario.comuna" placeholder="Comuna" class="from-control mb-2" required>
                </div>

                <div class="col-md-6">
                    <select v-model="usuario.genero" class="from-control mb-2" required>
                        <option value="" selected>Selecciona tu genero</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="O">Otro</option>
                    </select>
                    <input type="email" v-model="usuario.email" placeholder="Email" class="from-control mb-2" required>
                    <input type="number" v-model="usuario.fono" min="1" placeholder="Celular" class="from-control mb-2" required>


                    <select v-model="usuario.region" class="from-control mb-2" required>
                        <option value="" selected>Seleccione una región</option>
                        <option value="Arica y Parinacota">Arica y Parinacota</option>
                        <option value="Tarapacá">Tarapacá</option>
                        <option value="Antofagasta">Antofagasta</option>
                        <option value="Atacama">Atacama</option>
                        <option value="Coquimbo">Coquimbo</option>
                        <option value="Valparaíso">Valparaíso</option>
                        <option value="Región del Libertador Gral. Bernardo O’Higgins">Región del Libertador Gral. Bernardo O’Higgins</option>
                        <option value="Región del Maule">Región del Maule</option>
                        <option value="Región del Biobío">Región del Biobío</option>
                        <option value="Región de la Araucanía">Región de la Araucanía</option>
                        <option value="Región de Los Ríos">Región de Los Ríos</option>
                        <option value="Región de Los Lagos">Región de Los Lagos</option>
                        <option value="Región Aisén del Gral. Carlos Ibáñez del Campo">Región Aisén del Gral. Carlos Ibáñez del Campo</option>
                        <option value="Región de Magallanes y de la AntárVca Chilena">Región de Magallanes y de la AntárVca Chilena</option>
                        <option value="Región Metropolitana de Santiago">Región Metropolitana de Santiago</option>
                    </select>
                    <input type="date" v-model="usuario.f_naci" placeholder="Fecha Nacimiento" class="from-control mb-2" required>

                </div>
            </div>
            <button class="btn btn-primary" type="submit">Agregar</button>
        </form>
        <div class="row">
            <div class="col-md-12">
                <button @click="getUsers()" class="btn btn-success" type="submit">Ver listado de usuarios</button>
            </div>
        </div>
			<button id="btnvalida" class="btn btn-default">Valida RUT</button>
                  <p class="text-info" id="msgerror"></p>
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
</template>

<script>
    export default {
        data(){
            return{
                columns: [],
                tableData: [],
                options: {},
                usuario: {
                    rut: '', nombre: '', direccion: '', comuna: '', genero: '', email: '',
                    fono: '', region: '', f_naci: ''
                },
                editarActivo: false
            }
        },
        methods:{
            agregarUser(){

                if(this.usuario.nombre.trim() === '' || this.usuario.rut.trim() === '' || this.usuario.direccion.trim() === ''
                   || this.usuario.comuna.trim() === '' || this.usuario.email.trim() === '' || this.usuario.fono.trim() === ''
                   || this.usuario.region.trim() === ''){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }

                const data = {
                    rut: this.usuario.rut,
                    nombre: this.usuario.nombre,
                    f_naci: this.usuario.f_naci,
                    genero: this.usuario.genero,
                    email: this.usuario.email,
                    fono: this.usuario.fono,
                    direccion: this.usuario.direccion,
                    region: this.usuario.region,
                    comuna: this.usuario.comuna,
                }

                this.usuario.rut = '';
                this.usuario.nombre = '';
                this.usuario.f_naci = '';
                this.usuario.genero = '';
                this.usuario.email = '';
                this.usuario.fono = '';
                this.usuario.direccion = '';
                this.usuario.region = '';
                this.usuario.comuna = '';

                axios.post('/crud', data).then( res => {
                    alert('Usuario creado exitosamente!');
                }).catch((error) => {
                    console.log(error)
                });
            },

            eliminar(id){
                console.log(id)
                axios.delete(`/crud/${id}`).then( res => {
                    this.getUsers();
                    alert('El usuario ha sido eliminado exitosamente')
                })
            },

            editar(usuario){
                this.editarActivo = true;
                this.usuario.rut = usuario.rut;
                this.usuario.nombre = usuario.nombre;
                this.usuario.f_naci = usuario.f_naci;
                this.usuario.genero = usuario.genero;
                this.usuario.email = usuario.email;
                this.usuario.fono = usuario.fono;
                this.usuario.direccion = usuario.direccion;
                this.usuario.region = usuario.region;
                this.usuario.comuna = usuario.comuna;
                this.usuario.id = usuario.id;
                console.log(usuario);
            },

            getUsers(){
                axios.get('/crud').then( res => {

                    this.columns = ['rut', 'nombre', 'fono', 'email', 'direccion', 'comuna', 'region', 'eliminar', 'editar'];
                    this.tableData = res.data;
                    this.options = {
                        headings: {
                            rut: 'Rut',
                            nombre: 'Nombre',
                            fono: 'Celular',
                            email: 'Email',
                            direccion: 'Dirección',
                            comuna: 'Comuna',
                            region: 'Región',
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
                    rut: usuario.rut,
                    nombre: usuario.nombre,
                    f_naci: usuario.f_naci,
                    genero: usuario.genero,
                    email: usuario.email,
                    fono: usuario.fono,
                    direccion: usuario.direccion,
                    region: usuario.region,
                    comuna: usuario.comuna,
                }

                this.usuario.rut = '';
                this.usuario.nombre = '';
                this.usuario.f_naci = '';
                this.usuario.genero = '';
                this.usuario.email = '';
                this.usuario.fono = '';
                this.usuario.direccion = '';
                this.usuario.region = '';
                this.usuario.comuna = '';


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

                this.usuario.rut = '';
                this.usuario.nombre = '';
                this.usuario.f_naci = '';
                this.usuario.genero = '';
                this.usuario.email = '';
                this.usuario.fono = '';
                this.usuario.direccion = '';
                this.usuario.region = '';
                this.usuario.comuna = '';
            },

        }
    }
</script>
