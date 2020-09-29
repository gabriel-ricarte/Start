/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment'
moment.locale('pt_BR'); 
Vue.prototype.moment = moment
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('quadro-um', require('./components/QuadroPrimeiro.vue').default);
Vue.component('quadro-dois', require('./components/QuadroSegundo.vue').default);
Vue.component('quadro-last', require('./components/QuadroLast.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    data: {
        tasks: [],
        tasksdois: [],
        taskslast: [],
        //dado: [],
    },
    // },

    // created() {
    //     if( $('#todo').val() > 0){
    //         this.buscaTasks();
    //     }

    //     Echo.private('newtask')
    //     .listen('NovaTask', (e) => {
    //         this.buscaTasks();
    //     });
    //      Echo.private('taskmovida')
    //     .listen('TaskMovida', (e) => {
    //         this.buscaTasks();
    //     });
    // },

    methods: {
        atualiza(dado) {
            this.tasks = dado;
           // });
       }
            // axios.get('/buscaTask/'+$('#doing').val()).then(response => {
            //     this.tasksdois = response.data;
            // });
            // axios.get('/buscaTask/'+$('#done').val()).then(response => {
            //     this.taskslast = response.data;
            // });
        }


    //     // addMessage(message) {
    //     //     this.messages.push(message);

    //     //     axios.post('/messages', message).then(response => {
    //     //       console.log(response.data);
    //     //     });
    //     // }
    // }
});
