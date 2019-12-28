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
                      <a href="javascript:void(0)" class="btn btn-sm">
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
            </div>
          </div>
        </div>
      </div>
    </div>

    <add-client-modal-component
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


  </div>

</template>

<script>
  import AddClientModalComponent from "./Modals/AddClientModalComponent";
  import WatchClientModalComponent from "./Modals/WatchClientModalComponent";
  import DeleteClientModalComponent from "./Modals/DeleteClientModalComponent";
  export default {
      components: {DeleteClientModalComponent, WatchClientModalComponent, AddClientModalComponent},
      beforeMount(){
      let self = this;
      axios.get('/clients/')
          .then( response => {
              self.clientList = response.data.clients;
          })
          .catch( error => {
             console.log(error.response);
          });
    },
    data() {
      return {
        clientList: [],
        clientObject: {},
        clientCarships: [],
        clientName: '',
        clientid: null

      }
    },
    methods:{
      submitClient: function(data){
        axios.post('/clients/', data)
            .then( response => {
              this.clientList.push(response.data.client);
            })
            .catch( error => {
              console.log(error.response);
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
            })
      },
      openDeleteModal: function(clientname, clientid){
          this.clientName = clientname;
          this.clientId = clientid;
      },
      deleteClient: function(event){
          alert('deleted');
      }
    }
  }
</script>