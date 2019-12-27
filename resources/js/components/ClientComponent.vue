<template>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Clientes</div>
          <div class="card-body">
            <div class="text-center" v-if="clientList.length === 0">
              <h3> No se encontraron clientes </h3>
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