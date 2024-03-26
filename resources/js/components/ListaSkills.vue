
<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li
                class="border border-purple-500 px-3 py-2.5 mb-4 rounded mr-4 font-bold"
                :class="verificarClaseActiva(skill)"
                v-for="( skill, i )  in this.skills"
                :key="i"
                @click="activar($event)"
            >{{skill}}</li>
            
        </ul>

        <input type="hidden" name="skills" id="skills" >
    </div>
</template>


   

<script>        
    export default {


        props: ['skills', 'oldskills'],
        data: function() {
            return {
                habilidades: new Set()       //Los sets son muy similares a un arreglo, pero tiene una caracteristica y es que NOO permite datos repetidos
            }                               //Tambien es muy facil añadir y remover elementos de el
        },

        created: function() {
           if(this.oldskills) {
               const skillsArray = this.oldskills.split(',');                 //Aqui los 'oldskills' al principio de todo es un string al estar en el input hiden, por lo tanto al poner .split(',') estamos convirtiendo ese string a un arreglo separado con comas (,)
               skillsArray.forEach( skill => this.habilidades.add(skill) );   //En esta linea iteramos cada elem de oldskills y lo agregamos al arreglo de habilidades
           }
        },

        mounted: function() {
            document.querySelector('#skills').value = this.oldskills;       //Agregan al input hidden las oldSkills (Para poder enviarlas a la base de datos)
        },


        methods: {
            activar(e) {     

                if( e.target.classList.contains('bg-purple-700') ) {       //Accediendo a ls clases que contiene el elem , podemos ver que para el '$event' se hace con 'classList' y 'contains'
                    
                    e.target.classList.remove('bg-purple-700');            //Para remover cosas del '$event' se hace con 'remove'
                    this.habilidades.delete(e.target.textContent);         //La accion de Eliminar del set de habilidades es muy facil , 'delete'
                } 
                else 
                {
                    e.target.classList.add('bg-purple-700');                //Agregar cosas al '$event' con 'add'
                    this.habilidades.add(e.target.textContent);            //La accion de Agregar al set de habilidades con 'add'
                }



                // agregar las habilidades al input hidden, PARA ASI ENVIAR LOS DATOS A LA BASE DATOS  , 
                //Cabe aclarar que un SET no lo podemos agregar directamente a un input
                const stringHabilidades = [...this.habilidades];            //Primero tenemos que convertir el SET en un arreglo en este caso , y para ello usamos el 'spread operator' (" ... ")
                document.querySelector('#skills').value = stringHabilidades;     //Cabe aclarar que al agregarlo al input hidden el arreglo automaticamente se convierte en un string
                
            },


            //Esto se ve necesario a la hora de un fallo  de envio de formulario y se tengan que resaltar las oldskills
            verificarClaseActiva(skill) {
                return this.habilidades.has(skill) ? 'bg-purple-700' : '';      //con 'has' verificamos la existencia de un elemento en un SET
            }
        }
    }

</script>