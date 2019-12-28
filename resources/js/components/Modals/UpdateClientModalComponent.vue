<template>
  <div
    class="modal fade"
    id="edit-client-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="edit-client-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div id="">
          <form method="post" @submit.prevent="$emit('edit', data.client)">
            <div class="modal-header">
              <h5 class="modal-title vue-color">Editar cliente</h5>
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
                  v-model="data.client.name"
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
                  v-model="data.client.lastname"
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
                  v-model="data.client.email"
                  required>
              </div>
              <div class="form-group">
                <label for="client_car_dealership">Concesionarios</label>
                <select id="client_car_dealership" @change="carDealershipList" class="form-control custom-select" v-model="carships" name="carships[]">
                  <option
                    v-for="carship in carDealerships"
                    :key="carship.id"
                    :value="{id: carship.id, name: carship.name}">
                    {{carship.name}}
                  </option>
                </select>
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 bg-color margin-t-5 margin-l-5" v-for="carship in data.carDealership" :key="carship.id">
                      {{carship.name}} <span class="float-right" aria-hidden="true"><a href="javascript:void(0)" v-on:click="dellCarShip(carship.id)">&times;</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="edit-client-btn" class="btn vue-color-btn">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      name: "UpdateClientModalComponent",
      props: ['data'],
      beforeMount(){
        let self = this;
        axios.get('/car-dealerships/')
            .then(response => {
                self.carDealerships = response.data.car_dealerships;
            })
            .catch(error => {
                console.log(error.response)
            });
      },
      data(){
        return{
            carDealerships: [],
            carships: {},
            data: {
                name: '',
                lastname: '',
                email: '',
                carDealership: []
            }
        }
      },
      methods: {
        carDealershipList: function(){
            this.data.carDealership.push(this.carships);
        },
        dellCarShip: function(carShipId){
            for(let i = 0; i < this.data.carDealership.length; i++){
                if(this.data.carDealership[i].id === carShipId){
                    this.data.carDealership.splice(i, 1);
                }
            }
        }
      }
    }
</script>