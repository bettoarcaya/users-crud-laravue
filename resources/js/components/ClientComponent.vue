<template>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Clientes</h4>
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
    data() {
      return {
        clientList: [],
      }
    }
  }
</script>