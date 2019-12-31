<template>
  <div
    class="modal fade"
    id="delete-client-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="delete-client-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div id="">
          <div class="modal-header">
            <h5 class="modal-title vue-color">Eliminar Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="text-center vue-color">Seguro Desea eliminar a: {{this.data.clientname}}?</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="delete" id="add-client-btn" data-dismiss="modal" class="btn vue-color-btn" @click="$emit('delete')">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      name: "DeleteClientModalComponent",
      props: ['data'],
      data(){
       return {

       }
      }
    }
</script>