<template>
  <div
    class="modal fade"
    id="watch-client-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="watch-client-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div id="">
          <div class="modal-header">
            <h5 class="modal-title vue-color">{{this.data.client.name}} {{this.data.client.lastname}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
            </button>
          </div>
          <div class="modal-body no-padd">
            <div class="container-fluid vue-bg-color padd-10">
              <div class="text-center">
                <img class="img img-fluid round-img" :src="'/assets/icons/default.png'">
                <h4 class="vue-color">{{this.data.client.email}}</h4>
              </div>
            </div>
            <div class="container-fluid padd-10">
              <h4 class="vue-color">Concesionarios</h4>
              <ul class="list-group list-group-flush">
                <li class="list-group-item" v-for="carShip in this.data.carShips" :key="carShip.id">
                  <h6 class="vue-font">{{ carShip.name }} - {{ carShip.city }}</h6>
                </li>
              </ul>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      name: "WatchClientModalComponent",
      props: ['data'],
      data(){
          return{

          }
      }
    }
</script>