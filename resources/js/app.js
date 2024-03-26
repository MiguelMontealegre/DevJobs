/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('lightbox2');


import 'owl.carousel';
import vueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import Vue from 'vue';



window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//Aqui como tal terminamos de instalar sweetalert
Vue.use(vueSweetalert2);

// Vue.use(ElementUI);
import locale from 'element-ui/lib/locale/lang/es'
Vue.use(ElementUI, { locale })

//Componente para seleccionar skills de vacante
Vue.component('lista-skills', require('./components/ListaSkills.vue').default);

//Cambiar estado de vacante activa o inactiva
Vue.component('estado-vacante', require('./components/EstadoVacante.vue').default);

//Eliminar vacante
Vue.component('eliminar-vacante', require('./components/EliminarVacante.vue').default);

//Boton de like
Vue.component('like-button', require('./components/likeButton.vue').default);

Vue.component('comment-section', require('./components/CommentSection.vue').default);

Vue.component('vacantes-perfil', require('./components/VacantesPerfil.vue').default);

Vue.component('notifications-component', require('./components/Notifications.vue').default);

Vue.component('management-vacantes', require('./components/ManagementVacantes.vue').default);

Vue.component('chat-advance', require('./components/ChatAdvance.vue').default);

Vue.component('chat-list', require('./components/ChatList.vue').default);


Vue.component('chart-vacante', require('./components/ChartVacante.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});




//OWL-CAROUSEL __________________________________________________________________________________
jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
      
          //Separacion de elementos en el carrusel
      loop: true,    //Cuando el carrusel acabe repitalo infinitamente
      autoplay: true,   //Para que se mueva automaticamente
      autoplayHoverPause: true,    //Para que deje de moverse cunado pongamos en cursor sobre algun elemento
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1      //La herramienta 'responsive': Nos sirve en este caso para definir cuantos items mostrar dependiendo el disposiivo en el que se este navegando
        },
        1000:{
          items:1
        }
               }
    });  
  });
