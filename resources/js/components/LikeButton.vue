<template>
    <div>
        <span class="like-btn" @click="LikeReceta" :class="{ 'like-active': this.like }"></span>
        <p>{{ totalLikes }} Le gustó esta receta</p>
    </div>
</template>

<script>
export default {
    props: ['recetaId', 'like', 'likes'],
    data: function () {
        return {
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    methods:{
        LikeReceta() {
            axios.post('/recetas/' + this.recetaId)
                .then(respuesta => {
                    if (respuesta.data.attached.length){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive;
                })
                .catch(err => {
                   if (err.response.status === 401) {
                       window.location = '/register'
                   }
                    
                });

        }
    },
    computed:{
        cantidadLikes: function () {
            return this.likes
        }   
    }
}
</script>