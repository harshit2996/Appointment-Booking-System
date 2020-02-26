/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Vuetify from 'vuetify'
// import Chat from 'vue-beautiful-chat'

// Vue.use(Chat)

Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin', require('./components/admin.vue').default);
Vue.component('user', require('./components/user.vue').default);
Vue.component('theme', require('./components/theme.vue').default);
Vue.component('chat', require('./components/chat.vue').default);
Vue.component('chat-box', require('./components/chat-box.vue').default);
Vue.component('admin-chat', require('./components/admin-chat.vue').default);
Vue.component('user-table', require('./components/usertable.vue').default);
Vue.component('events-table', require('./components/events-table.vue').default);
Vue.component('u-events', require('./components/u-events.vue').default);
Vue.component('au-events', require('./components/au-events.vue').default);
Vue.component('event-form', require('./components/event-form.vue').default);
Vue.component('event-edit', require('./components/event-edit.vue').default);
Vue.component('calendar', require('./components/calendar.vue').default);


const ignoreWarnMessage = 'The .native modifier for v-on is only valid on components but it was used on <div>.';
Vue.config.warnHandler = function (msg, vm, trace) {
  // `trace` is the component hierarchy trace
  if (msg === ignoreWarnMessage) {
    msg = null;
    vm = null;
    trace = null;
  }
}


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */




const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    // chat : new Chat(),
  });
