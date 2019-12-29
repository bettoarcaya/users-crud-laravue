<template>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header principal-bg">
            <h4 class="float-left vue-color">Clientes</h4>
            <a
              class="btn vue-color-btn float-right"
              href="javascript:void(0)"
              data-toggle="modal"
              data-target="#add-client-modal">
              Agregar
            </a>
          </div>
          <div class="card-body">
            <div class="text-center" v-if="clientList.length === 0">
              <h5 class="vue-color"> No se encontraron clientes </h5>
            </div>
            <div v-else>
              <table class="table table-hover table-striped">
                <thead>
                  <tr class="vue-color">
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th colspan="2">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="client in clientList" :key="client.id">
                    <td>{{client.name}}</td>
                    <td>{{client.lastname}}</td>
                    <td>{{client.email}}</td>
                    <td width="10px">
                      <a
                        href="javascript:void(0)"
                        class="btn btn-sm"
                        data-toggle="modal"
                        data-target="#watch-client-modal"
                        v-on:click="openModal(client)">
                        <img
                          class="w-20-px"
                          :src="'/assets/icons/eye-solid.svg'">
                      </a>
                    </td>
                    <td width="10px">
                      <a
                        href="javascript:void(0)"
                        class="btn btn-sm"
                        data-toggle="modal"
                        data-target="#edit-client-modal"
                        v-on:click="openEditModal(client)">
                        <img
                          class="w-20-px"
                          :src="'/assets/icons/edit-solid.svg'">
                      </a>
                    </td>
                    <td width="10px">
                      <a
                        href="javascript:void(0)"
                        class="btn btn-sm"
                        data-toggle="modal"
                        data-target="#delete-client-modal"
                        v-on:click="openDeleteModal(client.name, client.id)">
                        <img
                          class="w-20-px"
                          :src="'/assets/icons/trash-alt-solid.svg'">
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="btn-group" v-if="pagInformation.total > 10">
                <button
                  class="btn vue-color-btn btn-sm"
                  @click="prevPage"
                  v-if="pagInformation.current_page !== 1">
                  <img :src="'/assets/icons/previous.svg'">
                </button>
                <button
                  class="btn vue-color-btn btn-sm"
                  @click="nextPage"
                  v-if="pagInformation.current_page !== pagInformation.last_page">
                  <img :src="'/assets/icons/next.svg'">
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <add-client-modal-component
      :value="{val: values}"
      v-on:submit="submitClient($event)"
    ></add-client-modal-component>

    <watch-client-modal-component
      :data="{
        client: clientObject,
        carShips: clientCarships
       }"
    ></watch-client-modal-component>

    <delete-client-modal-component
      :data="{clientname: clientName}"
      v-on:delete="deleteClient($event)"
    ></delete-client-modal-component>

    <update-client-modal-component
      :data="{client: clientObject, carDealerships: dealershipObject}"
      v-on:edit="editClient($event)"
    ></update-client-modal-component>


  </div>

</template>

<script>
  import AddClientModalComponent from "./Modals/AddClientModalComponent";
  import WatchClientModalComponent from "./Modals/WatchClientModalComponent";
  import DeleteClientModalComponent from "./Modals/DeleteClientModalComponent";
  import UpdateClientModalComponent from "./Modals/UpdateClientModalComponent";
  export default {
      components: {
          UpdateClientModalComponent,
          DeleteClientModalComponent,
          WatchClientModalComponent,
          AddClientModalComponent
      },
      beforeMount(){
      let self = this;
      axios.get('/clients/')
          .then( response => {
              self.clientList = response.data.clients.data;
              self.pagInformation = response.data.clients;
          })
          .catch( error => {
             console.log(error.response);
          });
    },
    data() {
      return {
        clientList: [],
        clientObject: {},
        dealershipObject: {},
        clientCarships: [],
        clientName: '',
        clientid: null,
        pagInformation: {},
        values: {
            name: '',
            lastname: '',
            email: '',
            carDealership: []
        }

      }
    },
    methods:{
      submitClient: function(data){
        let self = this;
        axios.post('/clients/', data)
            .then( response => {
                this.clientList.push(response.data.client);
                self.message('success', 'Usuario guardado satisfactoriamente');
                self.values = {
                    name: '',
                    lastname: '',
                    email: '',
                    carDealership: []
                };
            })
            .catch( error => {
                self.message('error', 'Ups, Por favor revise todos los campos requeridos');
            });
      },
      openModal: function(client){
        this.clientObject = client;
        let self = this;
        axios.get('/clients/car-dealerships/' + client.id)
             .then(response => {
                 self.clientCarships = response.data.ships;
             })
            .catch(error => {
                console.log(error.response);
            });
      },
      openEditModal: function(client){
        this.clientObject = client;
        let self = this;
        axios.get('/clients/car-dealerships/' + client.id)
            .then(response => {
                self.dealershipObject = response.data.ships;
            })
            .catch(error => {
                console.log(error.response);
            });
      },
      openDeleteModal: function(clientname, clientid){
          this.clientName = clientname;
          this.clientId = clientid;
      },
      deleteClient: function(event){
        let self = this;
        axios.delete('/clients/' + this.clientId)
             .then(response => {
                 self.clientList = response.data.clients.data;
                 self.pagInformation = response.data.clients;
                 self.message('success', 'Usuario eliminado satisfactoriamente');
             })
             .catch(error => {
                self.message('error', 'Ups, Porfavor intente nuevamente');
             });
      },
      editClient: function(event){
        let self = this;
        axios.put('/clients/' + event.clientInfo.id, event)
             .then(response => {
                 self.message('success', 'Usuario guardado satisfactoriamente')
             })
            .catch(error => {
                self.message('error', 'Ups, Porfavor intente nuevamente');
            });
      },
      nextPage: function(){
        let self = this;
        axios.get(this.pagInformation.next_page_url)
            .then( response => {
                self.clientList = response.data.clients.data;
                self.pagInformation = response.data.clients;
            })
            .catch( error => {
                console.log(error.response);
            });
      },
      prevPage: function(){
        let self = this;
        axios.get(this.pagInformation.prev_page_url)
            .then( response => {
                self.clientList = response.data.clients.data;
                self.pagInformation = response.data.clients;
            })
            .catch( error => {
                console.log(error.response);
            });
      },
      message: function(status, msg){
        const Swal = require('sweetalert2');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: status,
            title: msg
        });
      }
    }
  }
</script>