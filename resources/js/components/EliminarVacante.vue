<template>
    <span 
        style="font-size: 20px;cursor: pointer;"
        class="text-red-600 material-icons feather feather-plus" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
        @click="eliminarVacante">
        delete
    </span>
</template>

<script>
export default {
    props: ['vacanteId'],
    methods: {
        eliminarVacante() {
            // console.log('eliminando...', this.vacanteId)

            this.$swal.fire({
                title: '¿Deseas eliminar esta vacante?',
                text: "Una vez eliminada no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText:'No'
                }).then((result) => {
                    if (result.value) {

                        const params = {
                            id: this.vacanteId,
                            _method: 'delete'
                        }

                        // Enviar petición a axios
                        axios.post(`/vacantesEli/${this.vacanteId}`, params)
                            .then(respuesta => {
                                // console.log(respuesta)
                                this.$swal.fire(
                                    'Vacante Eliminada',
                                    respuesta.data.mensaje,
                                    'success'
                                );

                                // Eliminar del DOM
                                // this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                                
                                this.$emit('deleteAlert');

                            })
                            .catch(error => {
                                console.log(error);
                            })


                    }
                })
        }
    }

}
</script>
