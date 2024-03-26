
<!-- Codigo diseñado en CodePen , https://codepen.io/AlHakem/pen/yZGWxJ -->    
<template>
    <div>
         <i class="like-comm" @click="likeComment" :class="{ 'like-active' : isActive }"></i>
                                                     <!--Coloree el corazon si el valor d elike es true-->
                                                   
         <i class="font-bold">{{ cantidadLikes }}</i>
         
    </div>

</template>

<!------------------------------------------------------------>

<script>
    export default {
        props: ['commentId', 'likeComm', 'likesComm'],  //Recordar que hay que poner aqui tods las variables asociadas a el componente
        data: function() {
            return {
                isActive: this.likeComm,
                totalLikes: this.likesComm
            }
        },
        methods: {
            likeComment() {
                axios.post('/comentarioslikes/' + this.commentId)
                    .then(respuesta => {
                        if(respuesta.data.attached.length > 0 ) {    //attached - Cuando algo se agrega (likes) , aumenta ++ a el arreglo   
                            this.$data.totalLikes++;                //dettached - Cuando algo se quita (likes) , aumenta ++ en el arreglo de forma que con estos dos arreglos podemos conocer la cantidad de likes y la cantidad de deslikes(cuando deshacen el like)
                        } else {
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive   //si ya se le dio like se mantiene , si se le vuelve a dar se quita
                    })
                    .catch(error => {
                        if(error.response.status === 401) {   //Si el error se da por que el usuario esta tratando de dar like
                            window.location = '/register';   //Sin estar autenticado , entonces redirigirlo a la ventana de registro para que cree un usuario
                        }
                    });
            }
        }, 
        computed: {
            cantidadLikes: function() {     //Funcion encargada a mostrar la cantidad de likes de una receta,Recordar que en el props hay que poner la variable: $likes
                return this.totalLikes
            }
        }
    }
</script>
