/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Componentes de los usuarios
 */
Vue.component('index-user', require('./components/Users/Index.vue').default);
Vue.component('show-user', require('./components/Users/Show.vue').default);
Vue.component('create-user', require('./components/Users/Create.vue').default);
Vue.component('edit-user', require('./components/Users/Edit.vue').default);
Vue.component('account-user', require('./components/Users/Account.vue').default);
Vue.component('courses-user', require('./components/Users/Courses.vue').default);

/**
 * Componentes de los cursos
 */
Vue.component('index-course', require('./components/Courses/Index.vue').default);
Vue.component('create-course', require('./components/Courses/Create.vue').default);
Vue.component('edit-course', require('./components/Courses/Edit.vue').default);
Vue.component('show-course', require('./components/Courses/Show.vue').default);
Vue.component('courses-course', require('./components/Courses/Courses.vue').default);

/**
 * Componentes de los tutores
 */
Vue.component('index-tutor', require('./components/Tutors/Index.vue').default);
Vue.component('create-tutor', require('./components/Tutors/Create.vue').default);
Vue.component('edit-tutor', require('./components/Tutors/Edit.vue').default);

/**
 * Componentes de los Estados
 */
Vue.component('index-status', require('./components/Statuses/Index.vue').default);
Vue.component('create-status', require('./components/Statuses/Create.vue').default);
Vue.component('edit-status', require('./components/Statuses/Edit.vue').default);

 /**
  * Componentes de los tipos de curso
  */
Vue.component('index-tipos', require('./components/Types/Index.vue').default);
Vue.component('create-tipos', require('./components/Types/Create.vue').default);
Vue.component('edit-type', require('./components/Types/Edit.vue').default);

/**
 * Componentes de los roles
 */
Vue.component('index-roles', require('./components/Roles/Index.vue').default);
Vue.component('create-roles', require('./components/Roles/Create.vue').default);
Vue.component('edit-roles', require('./components/Roles/Edit.vue').default);

/**
 * Componentes de los permisos
 */
Vue.component('index-permissions', require('./components/Permissions/Index.vue').default);
Vue.component('create-permissions', require('./components/Permissions/Create.vue').default);
Vue.component('edit-permissions', require('./components/Permissions/Edit.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
