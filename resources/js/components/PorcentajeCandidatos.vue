<template>
      <div class="project-box-wrapper text-gray-800">
          <div class="project-box" :style="color">  <!--#fee4cb#ff942e    #e9e7fd#4f3ff0   #dbf6fd#096c86    #ffd3e2#df3670    #c8f7dc#34c471  #d5deff#4067f9-->
            <div class="project-box-header">
              <span>{{created}}</span>
              <div class="more-wrapper">
                <button class="project-btn-more">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="5" r="1" />
                    <circle cx="12" cy="19" r="1" /></svg>
                </button>
          </div>
        </div>
        <a :href="`/vacantes/${vacanteId}`" class="text-gray-800">
        <el-popover
            popper-class="custom-popover"
            placement="top"
            width="20"
            trigger="hover">
                    <!-- <div> -->
                        <!-- <h3 class="popover-header">Popover on Top</h3> -->
                        <div class="popover-body text-center">
                            <span class="material-icons text-red-600">favorite</span>{{likes}} &nbsp;&nbsp;
                            <span class="material-icons">forum</span>{{comentarios}}
                        </div>
                    <!-- </div> -->
                    <div class="project-box-content-header" slot="reference">
                        <p class="box-content-header">{{titulo}}</p>
                        <p class="box-content-subheader">{{categoria}}</p>
                    </div>
        </el-popover>   
        </a>
        <div class="box-progress-wrapper">
          <a class="text-gray-800" :href="`/candidatoss/${vacanteId}`"><p class="box-progress-header">{{candidatos}} Candidatos</p></a>



        <div class="box-progress-bar">
            <span class="box-progress" :style="porcent"></span>
          </div>
          

          <p class="box-progress-percentage">{{ porcentaje.toFixed() }}% </p>
        </div>
        <div class="project-box-footer">
          <div class="participants">
              <a :href="`/vacantes/${vacanteId}/edit`">
                <span style="font-size: 20px;" class="text-gray-600 material-icons feather feather-plus" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    edit
                </span>
              </a>
              <eliminar-vacante 
                @deleteAlert="deleteAlert2"
                :vacante-id="vacanteId"
              ></eliminar-vacante>
             <!-- </button>  -->
          </div>
          <div class="days-left">
            <estado-vacante
                @changeStatus="changeStatus2"
                :estado="estado"
                :vacante-id="vacanteId"
            ></estado-vacante>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import { Popover } from 'element-ui';
import EstadoVacante from './EstadoVacante.vue'
import EliminarVacante from './EliminarVacante.vue'
export default {
    components:{
        ElPopover:Popover,
        EstadoVacante,
        EliminarVacante
    },
    
    props:['porcentaje','titulo','categoria','candidatos','estado', 'vacanteId', 'created', 'imagen', 'keyid', 'likes', 'comentarios'],

    data(){
        return{

            colors: ['#fee4cb',  '#e9e7fd',  '#dbf6fd',  '#ffd3e2',  '#c8f7dc',  '#d5deff', '#E9DAC1', '#DEB6AB', '#EDE6DB', '#CA82FF'],
            barColors: ['#ff942e',  '#4f3ff0',  '#096c86',  '#df3670',  '#34c471',  '#4067f9', '#B09B71', '#85586F', '#417D7A', '#CDC2AE'],
        }
    },

    computed:{
        porcent(){
            return `width: ${this.porcentaje.toFixed()}%; background-color: ${this.barColors[this.keyid%10]};`;
        },

        color(){
            return `background-color: ${this.colors[this.keyid%10]};`;
        },
    },

    methods:{
        deleteAlert2(){
            this.$emit('deleteAlert3');
        },
        changeStatus2(){
            this.$emit('changeStatus3')
        }
    }
}
</script>

<style>
.custom-popover{
  height: 55px;
}
</style>