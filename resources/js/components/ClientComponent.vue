<template>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="float-left">Clientes</h4>
            <a class="btn btn-primary float-right" href="javascript:void(0)">Agregar</a>
          </div>
          <div class="card-body">
            <div class="text-center" v-if="clientList.length === 0">
              <h5> No se encontraron clientes </h5>
            </div>
            <div v-else>
              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    beforeMount(){
      let self = this;
      axios.get('/dashboard/clients/all')
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
      }
    }
  }
</script>