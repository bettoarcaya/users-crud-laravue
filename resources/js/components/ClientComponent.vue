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
                      <a href="javascript:void(0)" class="btn btn-sm">
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
                      <a href="javascript:void(0)" class="btn btn-sm">
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

    <!-- add client modal -->
    <div
      class="modal fade"
      id="add-client-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="add-client-modal"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div id="">
            <form method="post">
              <div class="modal-header">
                <h5 class="modal-title vue-color">Agregar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="client_name">Nombre</label>
                  <input
                    type="text"
                    id="client_name"
                    class="form-control"
                    placeholder="Nombre"
                    name="name"
                    required>
                </div>
                <div class="form-group">
                  <label for="client_lastname">Apellido</label>
                  <input
                    type="text"
                    id="client_lastname"
                    class="form-control"
                    placeholder="Apellido"
                    name="lastname"
                    required>
                </div>
                <div class="form-group">
                  <label for="client_email">Email</label>
                  <input
                    type="email"
                    id="client_email"
                    class="form-control"
                    placeholder="Email"
                    name="email"
                    required>
                </div>
                <div class="form-group">
                  <label for="client_car_dealership">Concesionarios</label>
                  <select id="client_car_dealership" @change="carDealershipList" class="form-control custom-select" v-model="carships" name="carships[]">
                    <option value="long">opcion1</option>
                    <option value="longer">opcion2</option>
                    <option value="longer longer">opcion2</option>
                  </select>
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4 bg-color margin-t-5 margin-l-5" v-for="carship in carDealership" :key="carship.id">
                        {{carship}} <span class="float-right" aria-hidden="true"><a href="javascript:void(0)">&times;</a></span>
                      </div>
                    </div>
                  </div>
                  <!--<input
                    type="email"
                    id="client_car_dealership"
                    class="form-control"
                    placeholder="Concesionarios"
                    name="car_dealerships"
                    multiple>-->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->

  </div>

</template>

<script>
  export default {
    beforeMount(){
      let self = this;
      axios.get('/dashboard/clients/all')
          .then( response => {
              self.clientList = response.data.clients;
              console.log(self.clientList);
          })
          .catch( error => {
             console.log(error.response);
          });
    },
    data() {
      return {
        clientList: [],
        carDealership: [],
        carships: '',
      }
    },
    methods:{
      carDealershipList: function(){
          this.carDealership.push(this.carships);
      }
    }
  }
</script>