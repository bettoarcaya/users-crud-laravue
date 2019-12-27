<template>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header principal-bg">
            <h4 class="float-left vue-color">Clientes</h4>
            <a class="btn vue-color-btn float-right" href="javascript:void(0)">Agregar</a>
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
                      <a href="javascript:void(0)" class="btn btn-warning btn-sm">V</a>
                    </td>
                    <td width="10px">
                      <a href="javascript:void(0)" class="btn btn-danger btn-sm">E</a>
                    </td>
                    <td width="10px">
                      <a href="javascript:void(0)" class="btn btn-danger btn-sm">E</a>
                    </td>
                  </tr>
                </tbody>
              </table>
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
              console.log(self.clientList);
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