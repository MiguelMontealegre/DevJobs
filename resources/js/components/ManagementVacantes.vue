<template>


<div class="app-container">
  <div class="app-header">
    <div class="app-header-left">
      <span class="app-icon"></span>

      
    </div>
    <div class="app-header-right">
      <button class="mode-switch" title="Switch Theme">
        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
          <defs></defs>
          <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
      </button>
      <button class="add-btn" title="Add New Project">
        <a href="/vacantes/create" class="text-white">  <!--{{route('vacantes.create')}}-->
        <svg class="btn-icon feather feather-plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19" />
          <line x1="5" y1="12" x2="19" y2="12" /></svg>
        </a>
      </button>
    </div>
  </div>

  <!--INTERFAZ DE IMG-->
  <div class="mt-3 flex flex-col lg:flex-row shadow bg-white" style="height:280px">
      <div class="lg:w-1/2 px-8 lg:px-12 py-6 lg:py-12">
          <p class="text-xl text-gray-700">
              Dev<span class="font-bold">Jobs</span>
          </p>
          <h1 class="mt-0 sm:mt-2 text-2xl font-bold  text-gray-700 leading-tight">
              Administra tus vacantes de la manera mas facil!!
              <span class="text-teal-400 block">Para Reclutadores / Empresas</span>
          </h1>
        <a href="/vacantes/create"> <p class="text-xl text-purple-700 btnn btn--2 mt-4">
            Nueva<span class="font-bold">Vacante ?</span>
        </p>  </a>
        </div>
        <!--Parte derecha ... imagen -->
        <div class="block lg:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-center rounded" src="material/img/FondoRecor.jpg" alt="devjobs">
        </div>
    </div>

    <div class="search-wrapper" style="margin-top: 30px;margin-left:37px">
        <!-- <input class="search-input" type="text" placeholder="Search Title Or Category" v-model="search"> -->
        <el-input
                @input="searchFunc"
                class="search-input"
                size="mini"
                placeholder="Search Title Or Category ..."
                clearable
                v-model="search"
                style="margin-top:12px"
            />
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search" viewBox="0 0 24 24">
          <defs></defs>
          <circle cx="11" cy="11" r="8"></circle>
          <path d="M21 21l-4.35-4.35"></path>
        </svg>
      </div>

  <div class="app-content">
    <div class="app-sidebar">
      <!---->
    </div>
    <div class="projects-section"
            element-loading-text="Loading..."
            element-loading-spinner="el-icon-loading"
            element-loading-background="rgba(255, 255, 255, 0.5)"
            v-loading="loading">
      <div class="projects-section-header">
        <p>Administra Tus Vacantes</p>
        <p class="time">December, 12</p>
      </div>
      <div class="projects-section-line">
        <div class="projects-status">


          <div class="item-status">
            <span class="status-number">{{total}}</span>   
            <span class="status-type">Total</span>
          </div>
          <div class="item-status">
            <span class="status-number">{{activas}}</span>     
            <span class="status-type">Activas</span>
          </div>
          <div class="item-status">
            <span class="status-number">{{inactivas}}</span> 
            <span class="status-type">Inactivas</span>
          </div>
        </div>
        <div class="view-actions">
          <button class="view-btn list-view" title="List View">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
              <line x1="8" y1="6" x2="21" y2="6" />
              <line x1="8" y1="12" x2="21" y2="12" />
              <line x1="8" y1="18" x2="21" y2="18" />
              <line x1="3" y1="6" x2="3.01" y2="6" />
              <line x1="3" y1="12" x2="3.01" y2="12" />
              <line x1="3" y1="18" x2="3.01" y2="18" /></svg>
          </button>
          <button class="view-btn grid-view active" title="Grid View">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
              <rect x="3" y="3" width="7" height="7" />
              <rect x="14" y="3" width="7" height="7" />
              <rect x="14" y="14" width="7" height="7" />
              <rect x="3" y="14" width="7" height="7" /></svg>
          </button>
        </div>
      </div>

<!---->
    <div class="project-boxes jsGridView" style="max-height:500px">   <!--v-if="data.length > 0"-->
        <porcentaje-candidatos 
          @deleteAlert3="handleData"
          @changeStatus3="handleData"
          :titulo="data.titulo"
          :categoria="data.nombCategoria"
          :candidatos="data.numCandidatos"
          :estado="data.estado"
          :vacante-id="data.id"
          :created="data.created"
          :porcentaje="data.porcentaje"
          :imagen="data.imagen"
          :keyid="index"
          :likes="data.numLikes"
          :comentarios="data.numComentarios"
          v-for="(data,index) in data" :key="index">
        </porcentaje-candidatos>
    </div>


    <el-empty v-if="data.length === 0">
      <a href="/vacantes/create">
        <el-button type="primary">Empezar</el-button>
      </a>
    </el-empty>

    <el-pagination
        @current-change="paginate"
        background
        style="margin-top: 13px;"
        :current-page.sync="generalData.current_page"
        :page-size.sync="generalData.per_page"
        layout="total, prev, pager, next, jumper"
        :total="generalData.total"
    />
</div>
</div>
</div>
    
</template>

<script>
import PorcentajeCandidatos from './PorcentajeCandidatos.vue'
import { debounce } from 'lodash';
export default {
    components:{
        PorcentajeCandidatos,
    },


    data(){
        return{
            generalData:{},
            data:[],
            search: '',
            loading: false,
        }
    },

    mounted(){
        this.handleData();
    },

    computed:{
        dataPro(){
            return this.data
        },
        total(){
            return this.data.length
        },
        activas(){
          return this.data.filter(dat => dat.estado === 1).length
        },
        inactivas(){
          return this.data.filter(dat => dat.estado === 0).length
        },
    //     filteredList() {
    //     return this.data.filter(dat => {
    //     return dat.titulo.toLowerCase().includes(this.search.toLowerCase()) || dat.categoria.toLowerCase().includes(this.search.toLowerCase())
    //   })
    // }

    },


    methods:{
        handleData(){
          this.loading = true;
          const params = this.getParams();
            axios.get('/vacantesIndex',{params})
            .then((response) => {
                console.log(response)   
                this.generalData = response.data
                this.data = response.data.data
                this.loading = false;
            }).catch((err) => {
                console.log(err)
            });  
        },
        // eslint-disable-next-line func-names
            searchFunc: debounce(function () {
                this.handleData();
            }, 500),

          getParams() {
                const params = {
                    search:this.search,
                    page: this.generalData.page,
                    per_page: this.data.per_page,
                };
                return params;
            },
            paginate(next) {
                if (next) {
                    this.generalData = { ...this.generalData, page: next };
                }
                this.handleData();
            },
    }
}
</script>

<style>

</style>

