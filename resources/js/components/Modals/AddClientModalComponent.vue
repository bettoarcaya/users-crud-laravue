<template>

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
          <form method="post" @submit.prevent="$emit('submit', value.val)">
            <div class="modal-header">
              <h5 class="modal-title vue-color">Agregar cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="client_name">Nombre <span class="required-color">*</span></label>
                <input
                  type="text"
                  id="client_name"
                  class="form-control"
                  placeholder="Nombre"
                  name="name"
                  v-model="value.val.name">
              </div>
              <div class="form-group">
                <label for="client_lastname">Apellido <span class="required-color">*</span></label>
                <input
                  type="text"
                  id="client_lastname"
                  class="form-control"
                  placeholder="Apellido"
                  name="lastname"
                  v-model="value.val.lastname">
              </div>
              <div class="form-group">
                <label for="client_email">Email <span class="required-color">*</span></label>
                <input
                  type="email"
                  id="client_email"
                  class="form-control"
                  placeholder="Email"
                  name="email"
                  v-model="value.val.email">
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
                    <div class="col-md-4 bg-color margin-t-5 margin-l-5" v-for="carship in value.val.carDealership" :key="carship.id">
                      {{carship.name}} <span class="float-right" aria-hidden="true"><a href="javascript:void(0)" v-on:click="dellCarShip(carship.id)">&times;</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="add-client-btn" class="btn vue-color-btn">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</template>

<script>
    export default {
      props: ['value'],
      beforeMount(){
        axios.get('/car-dealerships/')
             .then(response => {
                 this.carDealerships = response.data.car_dealerships;
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

            if( !this.checkList( this.carships ) ){
              this.value.val.carDealership.push(this.carships);
            }
        },
        dellCarShip: function(carShipId){
          for(let i = 0; i < this.value.val.carDealership.length; i++){
            if(this.value.val.carDealership[i].id === carShipId){
              this.value.val.carDealership.splice(i, 1);
            }
          }
        },
        checkList: function(value){
          let flag = false;
          for(let i = 0; i < this.value.val.carDealership.length; i++){
              if( this.value.val.carDealership[i].id === value.id ){
                  flag = true;
              }
          }
          return flag;
        }
      }
    }
</script>