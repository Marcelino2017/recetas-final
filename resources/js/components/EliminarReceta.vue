<template>
    <input 
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        name="eliminarReceta"
        value="Eliminar x"
        @click="eliminarReceta">
        
</template>

<script>
export default {
    props: ['recetaId'],
    methods: {
        eliminarReceta(){
            this.$swal({
                title: 'Deseas Eliminar la recetas?',
                text: "Una vez Eliminada no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'No'
            }).then((result) => {
                    if (result.isConfirmed) {
                        const params = {
                            id: this.recetaId
                        }

                        //Enivar la petción al servidor
                        axios.post(`recetas/${this.recetaId}`, {params, _method: 'delete'})
                            .then((respuesta) => {
                                this.$swal({
                                    title : 'Receta Eliminada',
                                    text  : 'Se Elimino la receta',
                                    icon  : 'success'

                                });

                                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                            })
                            .catch((error) =>{
                                console.log(error);
                            })

                        
                    }
            })
            
        }
    }
    
}
</script>